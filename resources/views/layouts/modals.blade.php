<!-- Modal -->
{{-- upload product modal --}}
<div class="modal fade" id="upload_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-body">
      <h1 class="supplier-database-header">Upload Product</h1>
      <form method="post" action="/upload_product" enctype='multipart/form-data'>
        @csrf
        <input type="text" class="form-field w-input" maxlength="256" name="type"  placeholder="Product Name"  required="">
        <input type="text" class="form-field w-input" maxlength="256" name="price"  placeholder="Price" required="">
        <textarea style="width:100%;" placeholder="Product description" name="description" class="form-field w-input" maxlength="256" rows="10" ></textarea>
        <input type="file" name="image" id="file" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" required />
        <label class="p-3 mt-2" for="file"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose an image&hellip;</span></label>
        {{-- <input type="file" class="input-fields w-input inputfile" maxlength="256" name="image"  required="">
        <label for="file">Choose a file</label> --}}
        <button class="button w-button mt-4">Upload</button>
      </form>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
{{-- auto email modal --}}
<div class="modal fade" id="auto_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-body">
      <h1 class="supplier-database-header">Send Mail</h1>
      <h4 style="text-align:center;" id="client_email"> </h4>
      <div class="w-row">
        {{-- <div class=" col-sm-12">
          <div><a id="contract_t" href="" class="button edit-button w-button">Contract Template</a></div>
        </div> --}}
        {{-- <div class="col-sm-12">
          <div><a id="loi_t" href="" class="button edit-button w-button">LOI Template</a></div>
        </div> --}}
        <div class=" col-sm-12">
          <div><a id="message" href="" class="button edit-button w-button">Send Mail</a></div>
        </div>

        <div class=" col-sm-12">
          <div><a id="mndnc" href="" class="button edit-button w-button">Send MNDNC</a></div>
        </div>
        {{-- <div class="col-sm-12">
          <div><a id="pol_t" href="" class="button edit-button w-button">POL Template</a></div>
        </div>
        <div class=" col-sm-12">
          <div><a id="pof_t" href="" class="button edit-button w-button">POF template</a></div>
        </div> --}}
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
{{-- auto email modal --}}
<div class="modal fade" id="auto_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-body">
      <h1 class="supplier-database-header">Send Mail</h1>
      <h4 style="text-align:center;" id="client_email"> </h4>
      <div class="w-row">
        {{-- <div class=" col-sm-12">
          <div><a id="contract_t" href="" class="button edit-button w-button">Contract Template</a></div>
        </div> --}}
        <div class="col-sm-12">
          <div><a id="loi_t" href="" class="button edit-button w-button">LOI Template</a></div>
        </div>
        <div class=" col-sm-12">
          <div><a id="custom_t" href="" class="button edit-button w-button">Custom Template</a></div>
        </div>
        <div class="col-sm-12">
          <div><a id="pol_t" href="" class="button edit-button w-button">POL Template</a></div>
        </div>
        <div class=" col-sm-12">
          <div><a id="pof_t" href="" class="button edit-button w-button">POF template</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
{{-- Delete products --}}
<div class="modal fade" id="del_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-body">
      <h1 class="supplier-database-header">Delete Product</h1>
      <h4 style="text-align:center;" id="client_email"> </h4>
      <div class="row">
      <div class="col-md-12">
        <p style="text-align:center">Are you sure you want to delete product</p>
        <a id="delete_product" href=""><button type="button" class=" col-md-4 float-right  btn btn-danger">Yes</button></a>
        <button type="button" data-dismiss="modal" class="btn col-md-4 float-left col btn-success">No</button>
      </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
{{-- upload documents --}}
<div class="modal fade" id="upload_doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-body">
      <h1 class="supplier-database-header">Upload Document</h1>
      <h4 style="text-align:center;" id="client_email"> </h4>
      <div class="row">
      <div class="col-md-12">
        <form action="/upload_doc" id="upload_doc_form" method="POST" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" name="id" value="{{$id ?? ''}}" />
            <input type="text" class="form-field w-input" maxlength="256" name="type"  placeholder="document name"  required="">
            <input type="file" class="form-field w-input" name="document" required/>
            <button class="btn btn-primary mt-4">Submit</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
{{-- upload product documents --}}
<div class="modal fade" id="upload_product_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-body">
      <h1 class="supplier-database-header">Upload product document</h1>
      <div class="row">
      <div class="col-md-12">
        <form action="/upload_product_file" method="POST" enctype='multipart/form-data'>
            @csrf
            <input type="hidden" name="id" value="{{$id ?? ''}}" />
            <input type="hidden" id="product_id" name="product_id" value="" />
            <input type="text" class="form-field w-input" maxlength="256" name="name"  placeholder="document name"  required="">
            <input type="file" class="form-field w-input" name="document" required/>
            <button class="btn btn-primary mt-4">Submit</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
