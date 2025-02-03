<?php

namespace App\Http\Controllers;

use App\Models\data;
use App\Models\service;
use App\Models\vehicleTestCenter;
use App\Models\vehicleTestPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CallController extends Controller
{
    public function index()
    {
        $data2 = data::all()->count();
        $data = number_format($data2);
        $vehicleTestCenter = vehicleTestCenter::all()->count();
        $vehicleTestPartner = vehicleTestPartner::all()->count();
        $service = service::all()->count();
        // dd($data);
        return view('index', compact('data', 'vehicleTestCenter', 'vehicleTestPartner', 'service'));
    }

    function vinCall($sn)
    {
        $response = Http::get('https://vi.vsafety.sa/api/sticker/details?sn=' . $sn);
        // $response = Http::get('https://vi.vsafety.sa/api/sticker/details?sn=2404105968');

        $data = $response->json();

        $status = $data['status'] ?? 0;

        if ($status) {
            $sn_id = $data['data']['id'];
            $vehicleTestCenterId = $data['data']['vehicleTestCenter']['id'];
            $vehicleTestPartnerId = $data['data']['vehicleTestCenter']['vehicleTestPartner']['id'];
            $serviceCode = $data['data']['service']['serviceCode'];

            $existsSn = data::where('sn_id', $sn_id)->exists();
            $existsTestCenter = vehicleTestCenter::where('test_center_id', $vehicleTestCenterId)->exists();
            $existsTestPatner = vehicleTestPartner::where('test_partner_id', $vehicleTestPartnerId)->exists();
            $existsService = service::where('service_code', $serviceCode)->exists();


            // dd($vehicleTestPartnerId); // Print the response and stop execution (for debugging)

            if (!$existsTestCenter) {
                vehicleTestCenter::create([
                    'test_center_id' => $vehicleTestCenterId ?? null,
                    'city_en' => $data['data']['vehicleTestCenter']['nameLang1'] ?? null,
                    'city_ar' => $data['data']['vehicleTestCenter']['nameLang2'] ?? null,
                    'address_en' => $data['data']['vehicleTestCenter']['firstAddressLang1'] ?? null,
                    'address_ar' => $data['data']['vehicleTestCenter']['firstAddressLang2'],
                    'email' => $data['data']['vehicleTestCenter']['email'] ?? null,
                    'phone_no' => $data['data']['vehicleTestCenter']['phoneNo'] ?? null,
                    'fax_no' => $data['data']['vehicleTestCenter']['faxNo'] ?? null,
                    'latitude' => $data['data']['vehicleTestCenter']['latitude'] ?? null,
                    'longitude' => $data['data']['vehicleTestCenter']['longitude'] ?? null,
                    'vehicle_test_partner_id' => $data['data']['vehicleTestCenter']['vehicleTestPartner']['id'] ?? null,
                    'supportDangerMaterials' => $data['data']['vehicleTestCenter']['supportDangerMaterials'] ?? false,
                ]);
            }

            if (!$existsTestPatner) {
                vehicleTestPartner::create([
                    'test_partner_id' => $vehicleTestPartnerId ?? null,
                    'partner_en' => $data['data']['vehicleTestCenter']['vehicleTestPartner']['nameLang1'] ?? null,
                    'partner_ar' => $data['data']['vehicleTestCenter']['vehicleTestPartner']['nameLang2'] ?? null,
                ]);
            }

            if (!$existsService) {
                service::create([
                    'service_code' => $serviceCode ?? null,
                    'service_name_en' => $data['data']['service']['serviceNameEn'] ?? null,
                    'service_name_ar' => $data['data']['service']['serviceNameAr'] ?? null,
                ]);
            }

            if (!$existsSn) {
                data::create([
                    'sn_id' => $sn_id,
                    'chassis_no' => $data['data']['chassisNo'] ?? null,
                    'plate_no' => $data['data']['plateNo'] ?? null,
                    'creation_date' => $data['data']['creationDate'] != null ? $this->timestamp($data['data']['creationDate']) : null,
                    'expire_date' => $data['data']['expireDate'] != null ? $this->timestamp($data['data']['expireDate']) : null,
                    'expired' => $data['data']['expired'] ?? false,
                    'vehicle_test_center_id' => $vehicleTestCenterId ?? null,
                    'vehicle_make_en' => $data['data']['vehicleMake']['nameLang1'] ?? null,
                    'vehicle_make_ar' => $data['data']['vehicleMake']['nameLang2'] ?? null,
                    'vehicle_model_en' => $data['data']['vehicleModel']['nameLang1'] ?? null,
                    'vehicle_model_ar' => $data['data']['vehicleModel']['nameLang2'] ?? null,
                    'service_id' => $serviceCode ?? null,
                ]);
            }
        }

        return $sn;
    }


    public function timestamp($timestamp)
    {
        $seconds = $timestamp / 1000;
        return date('Y-m-d H:i:s', $seconds);
    }


    public function test($sn)
    {
        dd($this->timestamp($sn));
    }
}
