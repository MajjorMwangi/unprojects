@can('project_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.projects.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.project.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.project.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-donorsProjects">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.project.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.paas_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.approval_status') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.fund') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.pag_value') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.lead_organisation_unit') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.theme') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.donors') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.total_expenditure') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.total_contribution') }}
                        </th>
                        <th>
                            {{ trans('cruds.project.fields.total_psc') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $key => $project)
                        <tr data-entry-id="{{ $project->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $project->id ?? '' }}
                            </td>
                            <td>
                                {{ $project->title ?? '' }}
                            </td>
                            <td>
                                {{ $project->paas_code ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Project::APPROVAL_STATUS_SELECT[$project->approval_status] ?? '' }}
                            </td>
                            <td>
                                {{ $project->fund->name ?? '' }}
                            </td>
                            <td>
                                {{ $project->pag_value ?? '' }}
                            </td>
                            <td>
                                {{ $project->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $project->end_date ?? '' }}
                            </td>
                            <td>
                                @foreach($project->countries as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $project->lead_organisation_unit->name ?? '' }}
                            </td>
                            <td>
                                @foreach($project->themes as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($project->donors as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $project->total_expenditure ?? '' }}
                            </td>
                            <td>
                                {{ $project->total_contribution ?? '' }}
                            </td>
                            <td>
                                {{ $project->total_psc ?? '' }}
                            </td>
                            <td>
                                @can('project_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.projects.show', $project->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('project_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.projects.edit', $project->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('project_delete')
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('project_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.projects.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-donorsProjects:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection