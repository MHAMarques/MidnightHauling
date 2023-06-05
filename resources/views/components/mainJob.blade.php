@props(['job'])
@php 
    use App\Models\Members; 
    $jobCargo = $job['cargo_definition']['groups'][0] ?? 'none';
    $typeCargo = $job['cargo_definition']['body_types'][0] ?? 'none';
    $cargoType = Members::jobIcons($jobCargo, $typeCargo);
@endphp


<h1 class="w-full mt-6">
    <span class="material-symbols-outlined text-xxl">{{$cargoType}}</span>{{$job['cargo_definition']['localized_names']['pt_br'] ?? $job['cargo_name']}} - {{$job['cargo_mass']}}T<br />
    <small class="flex items-center gap-4">
        lvl. [{{$job['driver']['level'] . '] ' . $job['driver']['name'] . ' - ' . $formattedDate = (new DateTime($job['completed_at']))->format('d / M / y') . ' - ' . $job['trailer_chain_type'] . ' '. $job['trailer_body_type']}}
    </small>
</h1>