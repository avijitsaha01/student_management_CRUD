@extends('layouts.app')

@section('title', 'Student Profile - ' . $student->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <!-- Navigation Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none">Students</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $student->name }}</li>
            </ol>
        </nav>

        <div class="card card-custom mb-4">
            <!-- Header Banner -->
            <div class="p-4 text-white profile-header">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div class="d-flex align-items-center flex-wrap gap-3 min-w-0">
                        <div class="avatar-circle bg-white text-primary shadow">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="fw-bold mb-1 text-break">{{ $student->name }}</h3>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="badge bg-light text-dark fw-bold font-monospace">{{ $student->student_id }}</span>
                                <span class="badge bg-light text-primary-emphasis fw-semibold">{{ $student->department }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 text-nowrap">
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm fw-semibold">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profile
                        </a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" data-confirm="Are you sure you want to delete {{ $student->name }} ({{ $student->student_id }})? This action cannot be undone.">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm fw-semibold">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Details Body -->
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3 text-secondary border-bottom pb-2">Academic & Contact Information</h5>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold d-block">Student ID</div>
                        <span class="fs-6 fw-bold font-monospace text-primary">{{ $student->student_id }}</span>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold d-block">Full Name</div>
                        <span class="fs-6 fw-bold text-dark">{{ $student->name }}</span>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold d-block">Email Address</div>
                        <a href="mailto:{{ $student->email }}" class="fs-6 fw-semibold text-decoration-none text-break">
                            <i class="bi bi-envelope me-1"></i>{{ $student->email }}
                        </a>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold d-block">Phone Number</div>
                        <a href="tel:{{ $student->phone }}" class="fs-6 fw-semibold text-dark text-decoration-none">
                            <i class="bi bi-telephone me-1 text-success"></i>{{ $student->phone }}
                        </a>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold d-block">Department</div>
                        <span class="badge-dept fs-6 d-inline-block">{{ $student->department }}</span>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold d-block">Semester</div>
                        <span class="badge-semester fs-6 d-inline-block">{{ $student->semester }}</span>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold d-block">Registration Date</div>
                        <span class="text-secondary">
                            <i class="bi bi-calendar3 me-1"></i>{{ $student->created_at ? $student->created_at->format('F d, Y h:i A') : 'N/A' }}
                        </span>
                    </div>

                    <div class="col-md-6">
                        <div class="text-muted small text-uppercase fw-semibold d-block">Last Updated</div>
                        <span class="text-secondary">
                            <i class="bi bi-clock-history me-1"></i>{{ $student->updated_at ? $student->updated_at->format('F d, Y h:i A') : 'N/A' }}
                        </span>
                    </div>
                </div>

                <hr class="my-4 text-muted">

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-stretch align-items-sm-center gap-2">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to Student List
                    </a>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-custom-primary">
                        <i class="bi bi-pencil me-1"></i> Edit This Student
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
