<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use App\Trainee;
use App\Trainer;
use Validator;
use Auth;

use App\Bounce;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth',['except' => ['bounces']]);
    }

    public function index()
    {
        $emailnumber = Trainee::whereNull('phone')->where('added_by', Auth::user()->id)->count();
        $smsnumber = Trainee::whereNull('email')->where('added_by', Auth::user()->id)->count();
        $teammembers = Trainer::where('company_id', Auth::user()->id)->count();
        return view('dashboard', compact('emailnumber','smsnumber', 'teammembers'));//dashboard page
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table(){
        $all = Trainee::where('added_by', Auth::user()->id)->get();
        return view('table', compact('all'));
    }

    public function newsletter(){
        return view('newsletter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request,[
            'company_id' => 'required|integer',
            'name' => 'required',
            'email' => 'required|email',
        ]);
        Trainer::create($request->all());
        alert()->success('You successfully added '. $request->name. ' to your team', 'Member Added!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bounces(Request $request)
    {
        Bounce::create(['event' => $request->event, 'recipient' => $request->recipient,'domain' => $request->domain]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showbounces()
    {
        $all = Bounce::all();
        return view('tablebounce', compact('all'));
    }

    public function downloadTxt()
    {
      $txt = "";
      $datas = Bounce::all();
      foreach($datas as $data){
      $txt .= $data['id'].'|'.$data['recipient'].PHP_EOL;
      }
      // $txtname = 'UnsentList.txt';
      // $headers = ['Content-type'=>'text/plain', 'test'=>'YoYo', 'Content-Disposition'=>sprintf('attachment; filename="%s"', $txtname),'X-BooYAH'=>'WorkyWorky','Content-Length'=>sizeof($datas)];
      //       return \Response::make($txt , 200, $headers );
      $response = new StreamedResponse();
        $response->setCallBack(function () use($txt) {
              echo $txt;
        });
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'logs.txt');
        $response->headers->set('Content-Disposition', $disposition);

        return $response;

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
    public function sendmail(){
        $data = array(
            'name' => "Konverge Media",
        );
    
        Mail::send('emails.pdf', $data, function ($message) {
    
            $message->from('admin@knvgmedia.com', 'Konverge Media');
    
            $message->to('john@webcoupers.com', 'olabode@webcoupers.com')->subject('Google Digital Skills');
    
        });
    
        return "Your email has been sent successfully";
    }
}
