<?php

namespace App\Http\Traits;

use App\Models\PageVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
// use MaxMind\Db\Reader;

trait UserAgentTraits
{

    public function clientIpAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $address = $_SERVER['REMOTE_ADDR'];
        }
        //select first IP from set of IPs returned by Opera browser
        $address = explode(",", $address)[0] ?? '';
        return $address;
    }

    public function locationInfo()
    {

        $user_ip = geoip()->getClientIP();
        $location = geoip()->getLocation($user_ip);
        $user_state = $location->state_name;
        $user_country = $location->country;
        return [
            'user_ip' => $user_ip,
            'user_state' => $user_state,
            'user_country' => $user_country,
        ];
    }


    public function deviceInfo()
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $browser_version = $agent->version($browser);
        $platform = $agent->platform();
        $platform_version = $agent->version($platform);
        $device_brand = $agent->device();
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'No User-Agent';
        try {
            $user_device = explode("(", $user_agent)[1];
            $user_device = explode(")", $user_device)[0];
        } catch (\Throwable $th) {
            $user_device = $user_agent ?? 'No User-Agent';
        }

        return [
            'device_info' => $user_device,
            'device_brand' => $device_brand,
            'os_version' => $platform . ' ' . $platform_version,
            'browser' => $browser . ' ' . $browser_version,
            'user_agent' => $user_agent,
        ];
    }

    public function getVisitLog(Request $request, String $page_identifier)
    {
        $full_url = $request->fullUrl();
        $username = !Auth::check() ? 'guest' : Auth::user()->username;
        $user_id = !Auth::check() ? 0 : Auth::user()->id;

        $location_info = $this->locationInfo();
        $device_info = $this->deviceInfo();
        $user_info = [
            'username' => $username,
            'user_id' => $user_id,
            'url' => $full_url,
        ];

        $log_data = array_merge($user_info, $device_info, $location_info);
        $log = new PageVisit();
        $log->username = $log_data['username'];
        $log->user_id = $log_data['user_id'];
        $log->url = $log_data['url'];
        $log->page_identifier = $page_identifier;
        $log->device_info = $log_data['device_info'];
        $log->device_brand = $log_data['device_brand'];
        $log->os_version = $log_data['os_version'];
        $log->browser = $log_data['browser'];
        $log->user_agent = $log_data['user_agent'];
        $log->user_ip = $log_data['user_ip'];
        $log->user_state = $log_data['user_state'];
        $log->user_country = $log_data['user_country'];
        $log->save();
    }
}
