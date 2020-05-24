@extends('layouts.app')
@section('content')
  <div>
    <form action="/send_loi" method="post">
      @csrf
    <div class="template-container w-container"><img src="images/jvtock-logo.png" width="150" alt="" class="image">
      <div class="text-block"><br><strong>JVTOCK Trading Corp.<br>‍</strong>5611 Goring St. Burnaby, BC, V5B 0A3<br></div>
      <h1 class="title"><strong class="bold-text">LETTER OF INTENT</strong><br></h1>
      <p class="paragraph parag-1">
        <span class="centered"><strong>THIS LETTER OF INTENT</strong> (the &quot;Document&quot;) made as of <input type="date" name="date_a" required/>   (the &quot;Execution Date&quot;),
        <br><strong><br>BETWEEN:	</strong>JVTOCK Trading Corp., of 5611 Goring Street, Burnaby, BC, V5B 0A3
        <br><br>On behalf of <input type="text" class="form-field w-input" name="buyer_info" required/><br>(the &quot;Purchaser&quot;)
        <br>‍<br><strong>- AND -
          <br>‍<br></strong>
          <select name="supplier_mail" id="supplier_list">
            <option>Choose Supplier</option>
            @foreach ($suppliers as $key => $value)
              <option  data-address="" value="{{$value->email}}"> {{$value->firstname}} {{$value->lastname}}. {{$value->address}}, {{$value->city}}, {{$value->country_name}}, {{$value->postal_code}}</option>
            @endforeach
          </select>
          <br><input class="mt-3 form-field w-input" id="supplier_details"  type="text" name="supplier_info" required/><br><br>(the &quot;Seller&quot;).
        </span><br><br><br></p>
      <p class="paragraph"><span class="centered"> <strong>BACKGROUND:<br><br></strong>
        1.<strong> </strong>The Seller is the owner of certain goods that are available for sale.<br>2. The Purchaser wishes to purchase the Goods from the Seller.<br><br>This Document will establish the basic terms to be used in a future contract for sale between the Seller and the Purchaser. The terms contained in this Document are not comprehensive and it is expected that additional terms may be added, and existing terms may be changed or deleted. The basic terms are as follows: <br><br>1. <strong>Non-Binding</strong><br>2. This Document does not create a binding agreement between the Purchaser and the Seller and will not be enforceable. Only the future contract for sale, duly executed by the Seller and the Purchaser, will be enforceable. The terms and conditions of any future contract for sale will supersede any terms and conditions contained in this Document. The Seller and the Purchaser are not prevented from entering into negotiations with third parties with regard to the subject matter of this Document.<br>3. <strong class="bold">Transaction Description
        <br>
      </strong>4.  <input type="text" class="form-field w-input" name="transaction_details" required/><br>
        <br>5. <strong class="bold">Purchase Price<br>
        </strong>6.  <input type="text" class="form-field w-input" name="purchase_price" required/><br>
        <br>7. <strong class="bold">Representations<br></strong>8. The Seller represents and warrants that the goods are free and clear of any aliens, charges, encumbrances or rights of others which will not be satisfied out of the sales proceeds. If the representations of the Seller are untrue upon the Closing Date, the Purchaser may terminate any future agreement without penalty and any deposits must be refunded.<br><br><br>This Document accurately reflects the understanding between the Seller and the Purchaser, signed on <input type="date" name="date_b" required/> . <br><br><strong>Signatures<br></strong><br>
        <br>For: JVTOCK Trading Corp. <br><strong>
          <br></strong>Name:  <input type="text" name="admin_name" required/>
          <br><br>Date: <input type="date" name="date_c" required/>                    Signature:  ____________________<br><br><br>For: 3M Corporate Headquarters<br><br>Name: ___________________<br><br>Date:       ____________________               Signature:  ____________________<br><br><br><br><br></p>
            <button type="btn" class="btn btn-primary" style="display:block;margin:auto;">Send</button>
    </div>

  </form>
  </div>

@endsection
