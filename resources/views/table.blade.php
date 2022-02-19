@if(count($rows) > 0)
    <table class="{{ $class ?? 'table' }} table-responsive-md mb-0">
        @if(count($columns))
        <thead>
            <tr>
            @foreach($columns as $c)
                <th {!! $c->getClasses() ? ' class="' . $c->getClassString() . '"' : '' !!}>
                    @if($c->isSortable())
                        <a href="{{ $c->getSortURL() }}">
                            {!! $c->getLabel() !!}
                            @if($c->isSorted())
                                @if($c->getDirection() == 'asc')
                                    <span class="fa fa-sort-asc"></span>
                                @elseif($c->getDirection() == 'desc')
                                    <span class="fa fa-sort-desc"></span>
                                @endif
                            @endif
                        </a>
                    @else
                        {{ $c->getLabel() }}
                    @endif
                </th>
            @endforeach

            </tr>
        </thead>
        @endif
        <tbody>
            @if(count($rows))
                @foreach($rows as $r)

            <tr>
                @foreach($columns as $c)
                    <td {!! $c->getClasses() ? ' class="' . $c->getClassString() . '"' : '' !!}>
                    @if($c->hasRenderer())
                        {{-- Custom renderer applied to this column, call it now --}}
                        {!! $c->render($r) !!}
                        @else
                        {{-- Use the "rendered_foo" field, if available, else use the plain "foo" field --}}
                            {!! $r->{'rendered_' . $c->getField()} ?? $r->{$c->getField()} !!}
                        @endif
                    </td>
                @endforeach

            </tr>

                @endforeach
            @endif
        </tbody>
    </table>
@else
    <div class='alert alert-info mb-0 text-center alert-table-no-result'>{{ __('Do not results') }}</div>
@endif

@if(is_object($rows) && class_basename(get_class($rows)) == 'LengthAwarePaginator')
    {{-- Collection is paginated, so render that --}}
    {!! $rows->appends(request()->except(['token']))->render() !!}
@endif
