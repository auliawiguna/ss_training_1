<script src="{!!asset('assets/js/app.js')!!}"></script>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    {!! \Form::open(['url' => '/createlink', 'method' => 'POST','class' => 'form-horizontal','id' => 'create_link']) !!}                
    <div class="input-group">
        <input type="text" name="url" class="form-control validate[required,custom[url]]" placeholder="Enter the URL">
        <div class="input-group-btn">
        <button class="btn btn-success" type="submit">
            <i class="glyphicon glyphicon-pencil"></i>
        </button>
        </div>
    </div>
    {!!\Form::close()!!}    
    <hr>
    <div class="col-md-12" id="result_url">Insert URL first !</div>
</div>