@extends('layouts.app')

@section('content')
<main>
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap hero-cap2 text-center pt-70">
                        <h2>Devotionals</h2>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container my-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse ($devotionals as $devotional)
                <div class="col-12">
                    <div class="devotional-column">
                        <h3 class="devotional-title">{{ $devotional->title }}</h3>
                        <p class="devotional-content">{{ $devotional->content }}</p>
                        <!-- Signature at the bottom right -->
                        <div class="signature">
                            <p>by Diana Beth</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="no-devotionals text-center">No devotionals available for your plan.</p>
            @endforelse
        </div>
    </div>

</main>
@endsection

@section('styles')
<style>
    /* General Styling */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }

    .hero-cap2 h2 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        padding: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Column Styling */
    .devotional-column {
        background: linear-gradient(135deg, #6a1b9a, #ff4081);
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 30px;
        display: flex;
        flex-direction: column;
        height: 100%;
        color: #fff;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .devotional-column:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .devotional-title {
        font-size: 2rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .devotional-content {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #fff;
        margin-bottom: 20px;
        font-style: italic;
    }

    /* Signature Styling */
    .signature {
        font-size: 1.1rem;
        font-style: normal;
        color: #fff;
        text-align: right;
        margin-top: auto;
        padding-right: 20px;
        padding-bottom: 10px;
    }

    /* Empty Devotionals Message */
    .no-devotionals {
        font-size: 1.2rem;
        font-weight: bold;
        color: #e74c3c;
        padding: 20px;
        border-radius: 5px;
        background-color: #f8d7da;
        text-align: center;
    }

    /* Ensuring space between columns */
    .row {
        margin-bottom: 30px;
    }

    .col {
        margin-bottom: 30px; /* Space between columns */
    }

    /* Responsive margin adjustments */
    @media (min-width: 992px) {
        .col {
            margin-bottom: 40px; /* Larger spacing for larger screens */
        }
    }
</style>
@endsection
