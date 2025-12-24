<h2> {{ $job->title }}</h2>
<p>
    Congrats! your job is live now on our website.
</p>
<p>
    <a href="{{ url('/jobs/' .$job->id ) }}"> view your most recent published job</a>
</p>
