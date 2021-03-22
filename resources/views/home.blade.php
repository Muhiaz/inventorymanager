@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
           <div class="row mt-3">
               <div class="col-md-4">
                   <div class="card1"><i class="fa fa-users"></i>
                   <h5>{{$suppliers}}</h5>
                   <h5>Suppliers</h5>
                   </div>
                   
               </div>
               <div class="col-md-4">
                   <div class="card2"><i class="fa fa-file"></i>
                   <h5>Orders</h5>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="card3"><i class="fa fa-briefcase"></i>
                   <h5>Stock</h5>
                   </div>
               </div>
               </div>
        </div>
    </div>
    </div>
</div>
@endsection
