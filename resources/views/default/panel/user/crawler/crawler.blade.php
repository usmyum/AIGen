@extends('panel.layout.app', ['disable_tblr' => true])
@section('title', 'Web Crawler')
@section('titlebar_subtitle', 'This is the page for web crawler')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Web Crawler</h3>
                <p class="text-muted">This is the page for web crawler</p>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.user.crawler.crawl') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="url" class="form-label">URL:</label>
                        <input type="text" class="form-control custom-border" id="url" name="url" required>
                    </div>
                    <div class="mb-3">
                        <label for="keywords" class="form-label">Keywords (comma-separated):</label>
                        <input type="text" class="form-control custom-border" id="keywords" name="keywords" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crawl</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .custom-border {
            border: 2px solid #007bff; /* Blue border for input fields */
            transition: border-color 0.3s ease-in-out;
        }

        .custom-border:focus {
            border-color: #28a745; /* Green border when input is focused */
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5); /* Green shadow for focus effect */
        }

        .card-header {
            background-color: #f8f9fa; /* Light background color for card header */
            border-bottom: 2px solid #007bff; /* Blue bottom border for card header */
        }

        .card {
            border: 2px solid #007bff; /* Blue border for the card */
            border-radius: 0.75rem; /* Slightly rounded corners */
        }

        .btn-primary {
            background-color: #007bff; /* Blue button */
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
@endsection
