@if($errors->has('content'))
    {{--Potrzeba czegos co przeniesie mnie do formularza--}}
    <script type="text/javascript">
        $(document).ready(function(){
            var divLoc = $('#scroll-to').offset();
            $('html, body').animate({scrollTop: divLoc.top}, "slow");
        });
    </script>
@endif
@if( $errors->count())
<div class="message is-error">
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
@if(session('message-error'))
    <div class="message is-error">
        <p>{{ session('message-error')}}</p>
    </div>
@endif
@if(session('message'))
    <div class="message">
        <p>{{ session('message')}}</p>
    </div>
@endif
@if(session('status'))
    <div class="message">
        <p>{{ session('status')}}</p>
    </div>
@endif
@if(session('_verified'))
    <div class="message">
        <p>Your email has been verified</p>
    </div>
@endif
@if(session('resent'))
    <div class="message">
        <p>Verification email has been send to you</p>
    </div>
@endif
