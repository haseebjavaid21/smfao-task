@extends('layouts.app')

@section('content')
<div class="container">


<div id="app">

	<bike-trail></bike-trail>

</div>
 

</div>
@endsection

<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"  type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-core-legacy.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service-legacy.js" type="text/javascript" charset="utf-8"></script>
<script src="{{ mix('js/app.js') }}"></script>
