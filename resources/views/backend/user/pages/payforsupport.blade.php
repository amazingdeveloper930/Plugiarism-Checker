@extends('backend.user.layouts.default')
@section('title', 'Plagiarismchecker | Pay For Result Page')
@section('description', "Plagiarismchecker | Pay For Result Page")
@section('content')

<div class="card">
                <div class="card-header card-header-warning card-header-icon">
            	<div class="card-icon">
                    <i class="material-icons">attach_money</i>
                  </div>
                  <h4 class="card-title ">Payment</h4>
                </div>
                
                <div class="card-body ">
                    @if(session('errors'))
                    <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <i class="material-icons">close</i>
                            </button>
                            <span>
                              <b> Error - </b> {{ session('errors') }}</span>
                          </div>
                    @endif
                    <form class="needs-validation"  id="payment-form" action="{{ route('cardinity') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p>You can pay the following price.
                                        Please use your payment card and fill following fields.</p>
                                <input type="hidden" name="report_id" value="{{ $report_id }}">                                
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="mode" value="5">
                            
                            <div class="col-md-3 mb-3">
                                <label for="cc-amount">Amount (USD)</label>
                                <input type="number" class="form-control" id="cc-amount" name="amount" placeholder="Full amount" required="true">
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="Full name as displayed on card" required="true">
                            </div>
                            <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="xxxx-xxxx-xxxx-xxxx" required="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration Month</label>
                            <input type="text" class="form-control" id="cc-expiration-month" name="cc-expiration-month" placeholder="xx" required="true">
                            </div>
                            <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration Year</label>
                            <input type="text" class="form-control" id="cc-expiration-year" name="cc-expiration-year" placeholder="xxxx" required="true">
                            </div>
                            <div class="col-md-3 mb-3">
                            <label for="cc-expiration">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="CVV" required="true">
                            </div>
                        </div>
                        <hr class="mb-4">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg" type="submit">Purchase</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
          

@stop