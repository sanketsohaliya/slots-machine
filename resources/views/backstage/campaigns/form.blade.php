@csrf

@include('backstage.partials.forms.text', [
    'field' => 'name',
    'label' => 'Name',
    'value' => old('name') ?? $campaign->name,
])

@include('backstage.partials.forms.select', [
    'field' => 'timezone',
    'label' => 'Timezone',
    'value' => old('timezone') ?? $campaign->timezone,
    'options' => $campaign->getAvailableTimezones(),
])

@include('backstage.partials.forms.starts-ends', [
    'starts_at' => old('starts_at') ?? ($campaign->starts_at === null ? $campaign->starts_at : $campaign->starts_at->format('d-m-Y H:i:s')),
    'ends_at' => old('ends_at') ?? ($campaign->ends_at === null ? $campaign->ends_at : $campaign->ends_at->format('d-m-Y H:i:s')),
])

@for($i=0;$i<10;$i++)
    @include('backstage.partials.forms.file', [
        'field' => 'symbols[]',
        'label' => 'Symbol ' . $i+1
    ])

    @include('backstage.partials.forms.text', [
        'field' => 'weights[]',
        'label' => 'Points for 3,4 and 5 Matches',
        'value' => '10,40,100',
    ])
@endfor

@include('backstage.partials.forms.submit')
