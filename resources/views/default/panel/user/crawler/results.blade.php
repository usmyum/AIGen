@extends('panel.layout.app', ['disable_tblr' => true])
@section('title', 'Crawl Results')
@section('titlebar_subtitle', 'Here are the results of your crawl')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Crawl Results</h3>
            </div>
            <div class="card-body">
                @if($crawledData->isEmpty())
                    <p>No data found for the given keywords.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>URL</th>
                            <th>Content</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($crawledData as $data)
                            <tr>
                                <td><a href="{{ $data->url }}" target="_blank">{{ $data->url }}</a></td>
                                <td>{{ $data->content }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <br>
                <br>
                <br>
                <h3 class="mt-5">Failed Crawls</h3>

                @if($failedCrawls->isEmpty())
                    <p>No failed crawls.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>URL</th>
                            <th>Error Message</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($failedCrawls as $failed)
                            <tr>
                                <td><a href="{{ $failed->url }}" target="_blank">{{ $failed->url }}</a></td>
                                <td>{{ $failed->error_message }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
