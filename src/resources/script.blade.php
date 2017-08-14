@if(session()->has('flash_messages'))
	<script>
		@php($timeout = 1)
		@foreach(array_reverse(session('flash_messages')) as $flash)
	        setTimeout(() => {
	            notify("{!! array_get($flash, 'message', '') !!}", '{{ array_get($flash, 'type', 'info') }}');
	        }, {{ $timeout }});
		@php($timeout += config('flash-messages.timeout'))
		@endforeach
	</script>
	@php(session()->forget('flash_messages'))
@endif