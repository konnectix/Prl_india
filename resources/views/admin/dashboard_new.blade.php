@extends('admin.layouts.app')

@section('title', 'Dashboard - Premier Roadlines Limited')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">Logistics Dashboard</h1>
        <p class="text-muted">Welcome back, {{ Auth::user()->name }}! Premier Roadlines Limited</p>
    </div>
    <div>
        <button class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Shipment
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="icon primary">
                <i class="fas fa-truck"></i>
            </div>
            <div class="number">156</div>
            <div class="label">Active Vehicles</div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="icon secondary">
                <i class="fas fa-box"></i>
            </div>
            <div class="number">2,847</div>
            <div class="label">Active Shipments</div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="icon primary">
                <i class="fas fa-route"></i>
            </div>
            <div class="number">89</div>
            <div class="label">Active Routes</div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="icon secondary">
                <i class="fas fa-rupee-sign"></i>
            </div>
            <div class="number">₹45.6L</div>
            <div class="label">Monthly Revenue</div>
        </div>
    </div>
</div>

<!-- Charts and Tables Row -->
<div class="row">
    <!-- Revenue Chart -->
    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="fas fa-chart-area me-2"></i>Revenue Overview
                </h6>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <button class="btn btn-outline-primary d-flex align-items-center">
                        <i class="fas fa-plus me-2"></i>New Shipment
                    </button>
                    <button class="btn btn-outline-primary d-flex align-items-center">
                        <i class="fas fa-truck me-2"></i>Add Vehicle
                    </button>
                    <button class="btn btn-outline-primary d-flex align-items-center">
                        <i class="fas fa-user-plus me-2"></i>Add Driver
                    </button>
                    <button class="btn btn-outline-danger d-flex align-items-center">
                        <i class="fas fa-route me-2"></i>Manage Routes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Shipments -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">
                    <i class="fas fa-shipping-fast me-2"></i>Recent Shipments
                </h6>
                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Shipment ID</th>
                                <th>Route</th>
                                <th>Vehicle</th>
                                <th>Driver</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Delivery Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#SH-001</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        Delhi - Mumbai
                                    </div>
                                </td>
                                <td>HR-26-AB-1234</td>
                                <td>Rajesh Kumar</td>
                                <td>₹45,000</td>
                                <td><span class="badge bg-success">In Transit</span></td>
                                <td>Dec 18, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Track">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#SH-002</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        Mumbai - Chennai
                                    </div>
                                </td>
                                <td>MH-12-CD-5678</td>
                                <td>Suresh Patel</td>
                                <td>₹52,000</td>
                                <td><span class="badge bg-warning">Loading</span></td>
                                <td>Dec 19, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Track">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#SH-003</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        Bangalore - Hyderabad
                                    </div>
                                </td>
                                <td>KA-03-EF-9012</td>
                                <td>Mohan Singh</td>
                                <td>₹38,500</td>
                                <td><span class="badge bg-info">Scheduled</span></td>
                                <td>Dec 20, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Track">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#SH-004</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        Kolkata - Guwahati
                                    </div>
                                </td>
                                <td>WB-19-GH-3456</td>
                                <td>Amit Das</td>
                                <td>₹41,200</td>
                                <td><span class="badge bg-success">Delivered</span></td>
                                <td>Dec 17, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Track">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#SH-005</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        Pune - Ahmedabad
                                    </div>
                                </td>
                                <td>GJ-01-IJ-7890</td>
                                <td>Vikas Sharma</td>
                                <td>₹33,800</td>
                                <td><span class="badge bg-danger">Delayed</span></td>
                                <td>Dec 18, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Track">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Revenue (₹ Lakhs)',
                data: [32, 38, 41, 35, 42, 48, 45, 52, 49, 46, 51, 45],
                borderColor: '#162f89',
                backgroundColor: 'rgba(22, 47, 137, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }, {
                label: 'Shipments',
                data: [180, 220, 195, 168, 210, 235, 225, 260, 245, 230, 255, 240],
                borderColor: '#e30f0e',
                backgroundColor: 'rgba(227, 15, 14, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                }
            }
        }
    });
</script>
@endsection
