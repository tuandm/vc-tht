<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShipmentEstimationRequest;
use Illuminate\Http\Request;

/**
 * @group Lunar Fashion project
 *
 * APIs for shipments
 */
class ShipmentController extends Controller
{
    /**
     * Shipment time estimation
     *
     * Estimate shipment time from the warehouse  to Lunar Colony. <br />
     * We accept past dates since sometimes we need to double-check the difference of the estimation and the actual time
     *
     * @response {'arrival_time': '47-12-01 ∇ 21:37:56'}
     *
     * @param ShipmentEstimationRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function estimate(ShipmentEstimationRequest $request)
    {
        $shipmentLeftTime = new \DateTime($request->input('shipment_left_time'));
        $deliverToEarthSpaceStationHours = config('shipment.earth_space_station_delivery_duration');
        $deliverToLunarColonyHours = config('shipment.lunar_colony_trip_duration');
        $totalDeliveryHours = $deliverToEarthSpaceStationHours + $deliverToLunarColonyHours;
        $shipmentLeftTime->modify('+' . $totalDeliveryHours . ' hours');

        try {
            $arrivalTime = lunar_date(config('shipment.lst_date_format'), $shipmentLeftTime->getTimestamp());
        } catch (\Exception $exception) {
            return response()->json([], $exception->getCode());
        }
        return response()->json(['arrival_time' => $arrivalTime]);
    }
}
