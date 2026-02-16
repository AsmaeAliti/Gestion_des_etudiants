@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<div>

    <div class="max-w-7xl mx-auto pt-5">

        <!-- Page Title -->
        <div class="mb-5 text-center">
            <h2 class="fw-bold text-dark">لوحة الإحصائيات</h2>
            <p class="text-muted">نظرة عامة على توزيع التلاميذ</p>
        </div>

        <div class="row g-4">

            <!-- Bar Chart Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-header bg-white border-0 text-center py-3">
                        <h6 class="fw-semibold text-primary mb-0">
                            عدد التلاميذ بناءً على الروافد
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <canvas id="BarChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Pie Chart Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-header bg-white border-0 text-center py-3">
                        <h6 class="fw-semibold text-pink-500 mb-0">
                            توزيع التلاميذ حسب الجنس
                        </h6>
                    </div>
                    <div class="card-body p-4 d-flex align-items-center justify-content-center">
                        <canvas id="PieChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Line Chart Card -->
            <div class="col-lg-4 col-md-12">
                <div class="card border-0 shadow-lg rounded-4 h-100">
                    <div class="card-header bg-white border-0 text-center py-3">
                        <h6 class="fw-semibold text-success mb-0">
                            عدد التلاميذ حسب نوع الإعاقة
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <canvas id="LineChart" height="250"></canvas>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/chart_v_45.min.js') }}" ></script>
    <script src="{{ asset('scripts/statistics.js') }}" ></script>
@endsection