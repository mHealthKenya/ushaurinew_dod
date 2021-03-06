<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\AppointmentType;
use Calendar;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function index()
    {
        return view('appointments.appointment_calender');

    }
    public function app_calendar()
    {

        if (Auth::user()->access_level == 'Facility') {
            $name = 'Total Apps:';
        $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('Total Apps: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
        ->groupBy('tbl_appointment.appntmnt_date')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->get();

        return response()->json($app_calendar_data);
        }
    }
    public function refill_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {

            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->join('tbl_clinic', 'tbl_clinic.id', '=', 'tbl_client.clinic_id')
            ->select('tbl_client.clinic_number', 'tbl_clinic.name as clinic', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('Re-fill: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Re-fill')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);

        }
    }

    public function refill_apps()
    {
        if (Auth::user()->access_level == 'Facility') {

            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->join('tbl_clinic', 'tbl_clinic.id', '=', 'tbl_client.clinic_id')
            ->select('tbl_client.clinic_number', 'tbl_clinic.name as clinic', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('Re-fill: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Re-fill')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return view('calendar.refill', compact('app_calendar_data'));

        }
    }

    public function clinical_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_client.clinic_number', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('Clinical Review: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Clinical Review')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function adherence_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_client.clinic_number', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('Adherence: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Enhanced Adherence')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function lab_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_client.clinic_number', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('Lab Investigation: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Lab Investigation')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function viral_load()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_client.clinic_number', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('Viral Load: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Viral Load')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function other_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_client.clinic_number', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('Other: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Other')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function pcr_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_client.clinic_number', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('PCR: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'PCR')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function normal_calender()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_client.clinic_number', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('Normal: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Normal')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function vl_cd_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_client.clinic_number', 'tbl_client.file_no', 'tbl_client.phone_no', 'tbl_appointment_types.name as app_type', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_appointment.appntmnt_date as start', DB::raw("CONCAT('VL/CD4: ', ' ', COUNT(tbl_appointment_types.id)) as title"), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'VL/CD4')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

}
