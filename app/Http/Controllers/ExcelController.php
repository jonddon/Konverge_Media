<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trainee;
use App\Bounce;
use DB;
use Mail;
use Barryvdh\DomPDF\Facade as PDF;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Alert;
use Auth;


class ExcelController extends Controller
{

    public function index($batch_id){
        $batch = Trainee::where('batch_id', $batch_id)->get();
        return view('inserted', compact('batch', 'batch_id'));
    }

    public function many($batch_id, $email){
        $batch = Trainee::where('batch_id', $batch_id)->get();
        return view('insertedmany', compact('batch', 'batch_id', 'email'));
    }

    public function sms($batch_id){
        $batch = Trainee::where('batch_id', $batch_id)->get();
        return view('insertedsms', compact('batch', 'batch_id'));
    }

    public function importFile(Request $request){
        try {

            if($request->hasFile('Excel_file')){

                $path = $request->file('Excel_file')->getRealPath();

                $data = \Excel::load($path)->get();
                $batch_id = 'batch'. str_random(10);

                if($data->count()){

                    foreach ($data as $key => $value) {

                        $arr[] = ['name' => $value->name, 'email' => $value->email, 'batch_id' => $batch_id, 'Notification Type' => 'Email', 'added_by' => Auth::user()->id];
                    }
     
                    if(!empty($arr)){

                        DB::table('trainees')->insert($arr);
                        alert()->success('Success Message', 'File Uploaded');
                        return redirect('inserted/'. $batch_id);

                    }
                }
            }

            dd('Request data does not have any files to import.');  
        } catch (Exception $e) {
        alert()->error('Reformat the file, click to download the sample format', 'Unexpected Format')->persistent('close');
        return back();
        }     

    } 

    public function importFileMany(Request $request){
        try {

            if($request->hasFile('Excel_file')){

                $path = $request->file('Excel_file')->getRealPath();

                $data = \Excel::load($path)->get();
                $batch_id = 'batch'. str_random(10);

                if($data->count()){

                    foreach ($data as $key => $value) {

                        $arr[] = ['name' => $value->name, 'batch_id' => $batch_id, 'Notification Type' => 'Email', 'added_by' => Auth::user()->id];
                    }
     
                    if(!empty($arr)){

                        DB::table('trainees')->insert($arr);
                        alert()->success('Success Message', 'File Uploaded');
                        return redirect('insertedmany/'. $batch_id .'/'. $request->email);

                    }
                }
            }

            dd('Request data does not have any files to import.');  
        } catch (Exception $e) {
        alert()->error('Reformat the file, click to download the sample format', 'Unexpected Format')->persistent('close');
        return back();
        }    

    } 

    public function sendEmail($batch_id){
        $trainees = Trainee::where('batch_id', $batch_id)->get();

        foreach ($trainees as $key => $trainee) {
            // $pdf = $this->generatefile($trainee);
            $data = array('name'=>$trainee->name, 'email'=>$trainee->email);
            

            Mail::queue('emails.haptics', $data, function($message) use ($data){
                $pdf = PDF::loadView('emails.pdf', $data)->setPaper('a4', 'landscape');

            $message->to($data['email'], $data['name'])->subject('Google Digital Skills For Africa Certificate');
            // $message->from('dsa@haptics.ng','Abesin Olabode');
            $message->attachData($pdf->output(), "GoogleDigitalSkillsCertificate.pdf");
        });

        }
        // Bounce::truncate();
        alert()->success('Emails Sending complete', 'Messages sent');
        return redirect('showbounces');
    }

    public function sendmanyemails($batch_id, $email){
        $data = Trainee::where('batch_id', $batch_id)->get();
        foreach ($data as $key => $trainee) {
            $data = array('name'=>$trainee->name, 'email'=>$email);
            Mail::queue('emails.haptics', $data, function($message) use ($data){

            $pdf = PDF::loadView('emails.pdf', $data)->setPaper('a4', 'landscape');

            $message->to($data['email'], $data['name'])->subject('Google Digital Skills For Africa Certificate');
            // $message->from('dsa@haptics.ng','Abesin Olabode');
            $message->attachData($pdf->output(), "GoogleDigitalSkillsCertificate.pdf");
        });
        }

        // Bounce::truncate();
        alert()->success('Emails Sending complete', 'Messages sent');
        return redirect('showbounces');
    }

    public function sendsms($batch_id){

    // $trainees = Trainee::where('batch_id', $batch_id)->pluck('phone');
    // $string = implode(',' , $trainees->toArray());
    // $textmessage = "This is the test -text message";

    $client = new Client(); //GuzzleHttp\Client
    $result = $client->get("http://www.multitexter.com/tools/geturl/Sms.php?username=olabode@webcoupers.com&password=webcoupers1&sender=Haptics&message=yourmessage&flash=1&listname=trainees&recipients=2349053599811"
        );
    dd($result);
    alert()->success('SMS Sending complete', 'Messages sent');
    return back();
    }
    public function resendEmail($id){
        try{
            $trainee = Trainee::find($id);
            $data = array('name'=>$trainee->name, 'email'=>$trainee->email);
            Mail::send('emails.haptics', $data, function($message) use ($data){
                $pdf = PDF::loadView('emails.pdf', $data)->setPaper('a4', 'landscape');

            $message->to($data['email'], $data['name'])->subject('Google Digital Skills For Africa Certificate');
            // $message->from('dsa@haptics.ng','Abesin Olabode');
            $message->attachData($pdf->output(), "GoogleDigitalSkillsCertificate.pdf");
        });
            alert()->success('Emails Sending complete', 'Messages sent');
            return back();
        }
        catch (Exception $e) {}
    }

   public function importsms(Request $request){
        try {
            if($request->hasFile('Excel_file')){
            $path = $request->file('Excel_file')->getRealPath();
            $data = \Excel::load($path)->get();
            $batch_id = 'batch'. str_random(10);
                if($data->count()){

                    foreach ($data as $key => $value) {

                        $arr[] = ['name' => $value->name, 'phone' => $value->phone, 'batch_id' => $batch_id, 'Notification Type' => 'sms', 'added_by' => Auth::user()->id];
                    }
     
                    if(!empty($arr)){

                        DB::table('trainees')->insert($arr);
                        alert()->success('Success Message', 'File Uploaded');
                        return redirect('inserted/sms/'. $batch_id);

                    }
                }
            }

            dd('Request data does not have any files to import.');  
        } catch (Exception $e) {
        alert()->error('Reformat the file, click to download the sample format', 'Unexpected Format')->persistent('close');
        return back();
        }    
  
   }
  

}
