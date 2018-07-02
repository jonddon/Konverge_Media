<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Newsletter;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Alert;
use Mail;


class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function send($batch_id){
        try {
            $data = Newsletter::where('batch_id', $batch_id)->get();
        foreach ($data as $key => $trainee) {
            $data = array('name'=>ucfirst($trainee->last_name), 'email'=>$trainee->email);
            Mail::queue('emails.newsletter', $data, function($message) use ($data){

            $message->to($data['email'], $data['name'])->subject('Take the Free Google digital skills online training to boost your career or business');
        });
        }

        // Bounce::truncate();
        alert()->success('Emails Sending complete', 'Messages sent');
        return redirect('showbounces');

        } catch (Exception $e) {
            
        }
    }

    public function newsletter(Request $request){
            try {

            if($request->hasFile('Excel_file')){

                $path = $request->file('Excel_file')->getRealPath();

                $data = \Excel::load($path)->get();
                $batch_id = 'batch'. str_random(10);

                if($data->count()){

                    foreach ($data as $key => $value) {

                        $arr[] = ['first_name' => $value->firstname, 'last_name' =>$value->lastname,'middle_name' =>$value->middlename,  'email' => $value->email, 'phone' =>$value->phonenumber, 'gender' => $value->gender, 'batch_id' => $batch_id, 'state' => $value->state, 'business_sector' => $value->businesssector, 'added_by' => 'ola'];
                    }
     
                    if(!empty($arr)){

                        DB::table('newsletters')->insert($arr);
                        $this->send($batch_id);
                        alert()->success('Success Message', 'File Uploaded and emails sent');
                        return back();

                    }
                }
            }

            dd('Request data does not have any files to import.');  
        } catch (Exception $e) {
        alert()->error('Reformat the file, click to download the sample format', 'Unexpected Format')->persistent('close');
        return back();
        }  
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
