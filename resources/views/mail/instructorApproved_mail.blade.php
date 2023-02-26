<div class="message">
    <h4>Congratulations ,</h4> <span><b>{{ $userName }}</b></span>

    <header style="margin-botton: 5px;">
        <h3>Instructor Request Approved</h3>
    </header>

    <div>
        <p>You are now eligible to teach on Codeside Academy</p>
        <p>Click the link below to access the dashboard</p>
    </div>
    <center>
    <div style="text-align: center; border: 2px solid #3d4682; border-radius: 8px; cursor: pointer; width: 150px; padding: 4px 4px 4px 4px; margin-bottom:30px;">
        <a href="{{ route('instructor.dashboard') }}" style="text-decoration: none; cursor: pointer;">  <b>Dashboard Link</b></a>
    </div>
    <center>
    <p>
        <b>The {{get_option('app_name')}} Team</b>
    </p>
</div>
