@extends('frontend.layout')
@section('title',"Anasayfa Başlığı")
@section('content')

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Contact
        <small>Subheading</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Contact</li>
    </ol>
    @if (session()->has('success'))
        <div class="alert alert-danger">
            <ul>
               <p>{{session('success')}}</p>
            </ul>
        </div>
    @endif


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content Row -->
    <div class="row">
        <!-- Map Column -->
        <div class="col-lg-8 mb-4">
            <!-- Embedded Google Map -->
            <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
            <h3>Contact Details</h3>
            <p>
                {!! $adres !!}
                <br>{{$ilce}}/{{$il}}
                <br>
            </p>
            <p>
                <abbr title="Phone">P</abbr>: {{$phone_gsm}} / {{$phone_sabit}}
        </div>
    </div>
    <!-- /.row -->

    <!-- Contact Form -->
    <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <h3>Send us a Message</h3>
            <form method="post">
                @csrf
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Full Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="control-group form-group">
                    <div class="controls">
                        <label>Mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Mail" required>
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="control-group form-group">
                    <div class="controls">
                        <label>Message:</label>
                        <textarea rows="10" cols="100" class="form-control" name="message" required></textarea>
                    </div>
                </div>
                <div id="success"></div>
                <!-- For success/fail messages -->
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Send Message</button>
            </form>
        </div>

    </div>
    <!-- /.row -->

    </div>
@endsection
@section('css') @endsection
@section('js') @endsection
