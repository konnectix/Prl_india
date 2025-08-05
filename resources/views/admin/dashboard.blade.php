@extends('admin.layouts.app')

@section('title', 'Dashboard - Premier Roadlines Limited')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex align-items-center">
        <div class="me-3">
            <div style="background-color: #ffffff; padding: 0.75rem; border-radius: 12px; border: 2px solid #162f89; box-shadow: 0 5px 15px rgba(0,0,0,0.1); display: inline-block;">
                <img src="{{ asset('assets/img/logo/logoprlindia.png') }}" alt="Premier Roadlines Limited" style="height: 40px; width: auto; display: block;">
            </div>
        </div>
        <div>
            <h1 class="h3 mb-0 text-gray-800">Website Content Management</h1>
            <p class="text-muted">Welcome back, {{ Auth::user()->name }}! Premier Roadlines Limited CMS</p>
        </div>
    </div>
    <div>

    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="icon primary">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="number">127</div>
            <div class="label">Total Pages</div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="icon secondary">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="number">43</div>
            <div class="label">Media Articles</div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="icon primary">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="number">89</div>
            <div class="label">Investor Documents</div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="icon secondary">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="number">156</div>
            <div class="label">Contact Inquiries</div>
        </div>
    </div>
</div>

<!-- Charts and Tables Row -->
<div class="row">
    <!-- Content Chart -->
    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="fas fa-chart-area me-2"></i>Website Analytics
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
                        <i class="fas fa-plus me-2"></i>Add New Page
                    </button>
                    <button class="btn btn-outline-primary d-flex align-items-center">
                        <i class="fas fa-newspaper me-2"></i>Add Media Article
                    </button>
                    <button class="btn btn-outline-primary d-flex align-items-center">
                        <i class="fas fa-file-upload me-2"></i>Upload Document
                    </button>
                    <button class="btn btn-outline-danger d-flex align-items-center">
                        <i class="fas fa-chart-line me-2"></i>View Analytics
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Content Updates -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>Recent Content Updates
                </h6>
                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Content ID</th>
                                <th>Section</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th>Updated By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#CN-001</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2 text-primary"></i>
                                        About PRL
                                    </div>
                                </td>
                                <td>Company Profile</td>
                                <td><span class="badge bg-info">Page Content</span></td>
                                <td><span class="badge bg-success">Published</span></td>
                                <td>Dec 18, 2024</td>
                                <td>Admin User</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#CN-002</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-chart-line me-2 text-primary"></i>
                                        Investor Relations
                                    </div>
                                </td>
                                <td>Financial Results Q3 2024</td>
                                <td><span class="badge bg-warning">Document</span></td>
                                <td><span class="badge bg-success">Published</span></td>
                                <td>Dec 19, 2024</td>
                                <td>Finance Team</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#CN-003</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-newspaper me-2 text-primary"></i>
                                        Media
                                    </div>
                                </td>
                                <td>Press Release - New Partnership</td>
                                <td><span class="badge bg-success">Article</span></td>
                                <td><span class="badge bg-warning">Draft</span></td>
                                <td>Dec 20, 2024</td>
                                <td>Media Team</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-success" title="Publish">
                                            <i class="fas fa-upload"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#CN-004</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-truck-moving me-2 text-primary"></i>
                                        Services
                                    </div>
                                </td>
                                <td>Project Transportation</td>
                                <td><span class="badge bg-info">Service Page</span></td>
                                <td><span class="badge bg-success">Published</span></td>
                                <td>Dec 17, 2024</td>
                                <td>Operations Team</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#CN-005</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-network-wired me-2 text-primary"></i>
                                        Network
                                    </div>
                                </td>
                                <td>Branch Network Update</td>
                                <td><span class="badge bg-primary">Location Data</span></td>
                                <td><span class="badge bg-danger">Pending Review</span></td>
                                <td>Dec 18, 2024</td>
                                <td>Network Team</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary" title="Review">
                                            <i class="fas fa-check"></i>
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
    // Website Analytics Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Page Views (Thousands)',
                data: [45, 52, 48, 61, 58, 67, 63, 72, 69, 75, 71, 78],
                borderColor: '#162f89',
                backgroundColor: 'rgba(22, 47, 137, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }, {
                label: 'Content Updates',
                data: [12, 18, 15, 23, 20, 28, 25, 32, 29, 31, 28, 35],
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
