@component("mail::message")
    <div class="text-center">
        <h2 class="text-center text-dark">Reset Your Password</h2>
        <hr>
        <p class="lead">  
            <b class="text-center text-secondary">
                <center>
                    We're sending you this email because you requested
                    a password reset. Click on this link to create a new
                    password:
                </center>
            </b>
        </p>
        <a href="{{ env('WEBSITE')."/reset-password"."/".encrypt($customer['id'])}}" style="background: #6f42c1 !important" class="shadow-sm border my-4 btn btn-lg btn-primary rounded-pill"> 
            <small><b>Set a new password</b></small>
        </a>
        <div class="text-center">
        Please use the following temporary password to verify yourself
        </div>
        <div class="text-center">
            <p class="text-center">If you did not initiate this request, please contact us immediately at</p>
            <p class="text-center"><a href="mailto:support@aecprefab.net">{{ env('FOOTER_EMAIL') }}</a></p>
            <br>
            <b>The Anand Lab Team</b>
        </div>
    </div>
@endcomponent