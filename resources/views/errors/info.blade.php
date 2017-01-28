@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if($errors->has('alert-' . $msg))
  <div class="alert alert-{{ $msg }}">
        <p>{{ $errors->first('alert-' . $msg) }}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
  </div>
  @endif
@endforeach
