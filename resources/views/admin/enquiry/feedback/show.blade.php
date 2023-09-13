@extends('admin.enquiry.layout')

@section('admin_enquiry_content')
    <div class="card custom mb-3">
        <div class="card-header">
            <div class="card-title">
                Feed back Details
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-primary ms-3">
                <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                Go back
            </a>
        </div>
        <div class="card-body">
            <table class="table m-0 h-100">
                @foreach ($data->toArray() as $column => $value)
                    @if ($column != 'id' && $column != 'qa_comments')
                        <tr>
                            <td width="25%">
                                <strong class="fw-bold ft-cap">{{ Str::headline($column) }}</strong>
                            </td>
                            <td width="5%" class="text-center">:</td>
                            <td width="65%">{{ $value ?? '-' }}</td>
                        </tr>
                    @endif
                @endforeach
                @if (!is_null($data->qa_comments))
                    @if (strstr($data['page_url'], 'feedback-b2b'))
                        @foreach (json_decode($data->qa_comments) as $key => $row)
                            <tr>
                                <td width="25%"><strong>{{ ucfirst($row->question) }}</strong>:</td>
                                <td width="5%" class="text-center">:</td>
                                <td width="65%"> {{ $row->answer }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endif
            </table> 
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if (!strstr($data['page_url'], 'feedback-b2b'))
                <table cellpadding="10" cellspacing="10">
                    <thead>
                        <tr>
                            <th>Q.No</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Comment </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($data->qa_comments) as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->question }}</td>
                                <td>{{ $row->answer == 1 ? 'Yes' : 'No' }}</td>
                                <td>{{ $row->comments ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection