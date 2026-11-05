@extends('layouts.app')

@section('title', 'Students List - ZUMS Student Management System')

@section('content')
<div class="page-heading d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">Student Records</h2>
        <p class="text-muted mb-0">Overview and management of all enrolled students</p>
    </div>
    <div class="page-heading-actions">
        <a href="{{ route('students.create') }}" class="btn btn-custom-primary">
            <i class="bi bi-person-plus-fill me-1"></i> Add New Student
        </a>
    </div>
</div>

<!-- Dashboard Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card primary shadow-sm">
            <div class="stat-title">Total Students</div>
            <div class="stat-number">{{ $totalStudents }}</div>
            <i class="bi bi-people-fill stat-icon" aria-hidden="true"></i>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card success shadow-sm">
            <div class="stat-title">Academic Departments</div>
            <div class="stat-number">{{ $totalDepartments }}</div>
            <i class="bi bi-buildings-fill stat-icon" aria-hidden="true"></i>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card indigo shadow-sm">
            <div class="stat-title">Active Semesters</div>
            <div class="stat-number">{{ $totalSemesters }}</div>
            <i class="bi bi-journal-bookmark-fill stat-icon" aria-hidden="true"></i>
        </div>
    </div>
</div>

<!-- Main Table Card -->
<div class="card card-custom">
    <div class="card-header bg-white py-3 border-bottom">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
            <div class="d-flex align-items-center flex-wrap gap-2">
                <i class="bi bi-table text-primary fs-5" aria-hidden="true"></i>
                <h5 class="mb-0 fw-bold">All Registered Students</h5>
                <span class="badge bg-secondary rounded-pill">{{ $students->count() }} records</span>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('students.index') }}" class="student-search d-flex gap-2" role="search">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-search text-muted" aria-hidden="true"></i>
                    </span>
                    <input
                        type="search"
                        name="search"
                        class="form-control border-start-0"
                        placeholder="Search students..."
                        value="{{ request('search') }}"
                        aria-label="Search students"
                    >
                    @if(request('search'))
                        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary" title="Clear Search" aria-label="Clear search">
                            <i class="bi bi-x-lg" aria-hidden="true"></i>
                        </a>
                    @endif
                    <button class="btn btn-primary px-3" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body p-0">
        @if($students->count() > 0)
            <!-- Mobile card list (below md) -->
            <div class="d-md-none">
                @foreach($students as $student)
                    <article class="student-mobile-card">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <div class="min-w-0">
                                <h6 class="student-name mb-1 text-break">{{ $student->name }}</h6>
                                <span class="badge-id">{{ $student->student_id }}</span>
                            </div>
                            <div class="action-buttons flex-shrink-0">
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline-secondary" title="View Details" aria-label="View {{ $student->name }}">
                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-outline-primary" title="Edit Student" aria-label="Edit {{ $student->name }}">
                                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline-flex m-0" data-confirm="Are you sure you want to delete {{ $student->name }} ({{ $student->student_id }})? This action cannot be undone.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete Student" aria-label="Delete {{ $student->name }}">
                                        <i class="bi bi-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <span class="badge-dept">{{ $student->department }}</span>
                            <span class="badge-semester">{{ $student->semester }}</span>
                        </div>

                        <div class="d-flex flex-column gap-1 mt-2">
                            <a href="mailto:{{ $student->email }}" class="contact-link" title="{{ $student->email }}">
                                <i class="bi bi-envelope text-primary" aria-hidden="true"></i>
                                <span class="text-truncate">{{ $student->email }}</span>
                            </a>
                            <a href="tel:{{ $student->phone }}" class="contact-link" title="{{ $student->phone }}">
                                <i class="bi bi-telephone text-success" aria-hidden="true"></i>
                                <span>{{ $student->phone }}</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Desktop / tablet table (md and up) -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-custom align-middle mb-0" aria-label="Student records">
                    <thead>
                        <tr>
                            <th scope="col" class="d-none d-xxl-table-cell">#</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Student</th>
                            <th scope="col" class="d-none d-lg-table-cell">Email Address</th>
                            <th scope="col" class="d-none d-xxl-table-cell">Phone</th>
                            <th scope="col" class="d-none d-lg-table-cell">Department</th>
                            <th scope="col">Semester</th>
                            <th scope="col" class="text-center table-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td class="text-muted fw-semibold d-none d-xxl-table-cell">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge-id">{{ $student->student_id }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark text-break">{{ $student->name }}</div>
                                    <div class="small text-muted text-break d-lg-none">{{ $student->email }}</div>
                                    <div class="mt-1 d-lg-none">
                                        <span class="badge-dept">{{ $student->department }}</span>
                                    </div>
                                </td>
                                <td class="d-none d-lg-table-cell">
                                    <a href="mailto:{{ $student->email }}" class="text-decoration-none text-muted d-inline-flex align-items-center text-break">
                                        <i class="bi bi-envelope me-1 text-primary" aria-hidden="true"></i>{{ $student->email }}
                                    </a>
                                </td>
                                <td class="d-none d-xxl-table-cell">
                                    <span class="text-muted d-inline-flex align-items-center text-nowrap">
                                        <i class="bi bi-telephone me-1 text-success" aria-hidden="true"></i>{{ $student->phone }}
                                    </span>
                                </td>
                                <td class="d-none d-lg-table-cell">
                                    <span class="badge-dept">{{ $student->department }}</span>
                                </td>
                                <td>
                                    <span class="badge-semester">{{ $student->semester }}</span>
                                </td>
                                <td class="text-center table-actions">
                                    <div class="action-buttons">
                                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline-secondary" title="View Details" aria-label="View {{ $student->name }}">
                                            <i class="bi bi-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-outline-primary" title="Edit Student" aria-label="Edit {{ $student->name }}">
                                            <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline-flex m-0" data-confirm="Are you sure you want to delete {{ $student->name }} ({{ $student->student_id }})? This action cannot be undone.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Student" aria-label="Delete {{ $student->name }}">
                                                <i class="bi bi-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5 px-3">
                <i class="bi bi-folder2-open display-5 text-muted mb-3 d-block" aria-hidden="true"></i>
                <h5 class="fw-bold text-secondary">No Students Found</h5>
                @if(request('search'))
                    <p class="text-muted mb-3">No student matched your search query "<strong>{{ request('search') }}</strong>".</p>
                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-secondary">Clear Search Filter</a>
                @else
                    <p class="text-muted mb-3">No student records are currently available in the database.</p>
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-custom-primary">
                        <i class="bi bi-person-plus-fill me-1"></i> Register First Student
                    </a>
                @endif
            </div>
        @endif
    </div>

    @if($students->count() > 0)
        <div class="card-footer bg-white border-top py-3 text-muted small">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                <span>Showing <strong>{{ $students->count() }}</strong> student record(s)</span>
                <span>Database: <strong>crud_app</strong> <span class="d-none d-sm-inline">&bull;</span> Table: <strong>students</strong></span>
            </div>
        </div>
    @endif
</div>
@endsection
