@include('register/header')

<body>
<div class="container">
    <div class="card bg-light">
        <div class="col-md-4"></div>
        <article class="card-body mx-auto col-md-4">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <p class="text-center">Get started with your free account</p>
            {!! \Form::open(['url' => '/register', 'method' => 'POST','class' => 'form-horizontal','id' => 'registration_form']) !!}                
                <div class="form-group">
                    {!!Form::text('name',null,['class' => 'form-control validate[required]' , 'placeholder' => 'Full Name'])!!}
                </div> <!-- form-group// -->
                <div class="form-group">
                    {!!Form::email('email',null,['class' => 'form-control validate[required,custom[email]]' , 'placeholder' => 'Valid Email'])!!}
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    {!!Form::password('password',['class' => 'form-control validate[required]' , 'placeholder' => 'Password', 'id' => 'password'])!!}
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    {!!Form::password('password2',['class' => 'form-control validate[required,equals[password]]' , 'placeholder' => 'Repeat Password' , 'id' => 'password2'])!!}
                </div> <!-- form-group// -->                                      
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
                </div> <!-- form-group// -->      
                <p class="text-center">Have an account? <a href="{{url('')}}">Log In</a> </p>                                                                 
            {!!Form::close()!!}
        </article>
        <div class="col-md-4"></div>
    </div> <!-- card.// -->
</div> <!-- card.// -->
</body>
</html>


<script>
$('#registration_form').validationEngine();
$('#registration_form').on('submit',function(){
    if($(this).validationEngine('validate')){

    }else{
        return false;
    }
});

</script>