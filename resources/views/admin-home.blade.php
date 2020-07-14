@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 flex">
            <button class="btn btn-default text-center"> Add Branch </button>
        </div>

        <div class="col-md-6">
            <code>Search Button here</code>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 admin-branches">
            <div class="card-branch">
                <div class="text-white card-branch__header">
                    >
                    <div class="w-50">
                        <h6>Caniogan, Pasig</h6>
                        <span>Branch ID: 000000000</span>
                    </div>
                    <div class="w-50">
                        <h6>Status Active</h6>
                        <span>Date Opened: 9/1/2020</span>
                    </div>
                </div>
                <div class="text-dark card-branch__content">
                    <div class="card-branch_address">
                        <img src="https://via.placeholder.com/20" alt="Location Icon">
                        <address>213 Gemini St. Rainbow Village 2, UPS 5, Sucat Rd. San Isidro, Metro Manila - Paranaque City 1700, NCR</address>
                    </div>
                    <div class="card-branch_personels">
                        <img src="https://via.placeholder.com/20" alt="Person Icon">
                        <div class="personel">
                            <span class="personel__name">John Doe</span>
                            <span class="personel__position">Manager</span>
                            <span class="personel__email-number">johndoe@gmail.com, (+63)9771418394</span>
                        </div>
                        <div class="checkbox switcher">
                            <label for="test">
                              <input type="checkbox" id="test" value="">
                              <span><small></small></span>
                              <small>Light switch</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
