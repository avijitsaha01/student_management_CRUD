@extends('layouts.app')

@section('title', 'Edit Student - ' . $student->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <!-- Navigation Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none">Students</a></li>
                <li class="breadcrumb-item"><a href="{{ route('students.show', $student->id) }}" class="text-decoration-none">{{ $student->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>

        <div class="card card-custom">
            <div class="card-header bg-white py-3 border-bottom d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                <div>
                    <h5 class="mb-1 fw-bold text-dark">
                        <i class="bi bi-pencil-square text-primary me-2"></i>Edit Student Information
                    </h5>
                    <p class="text-muted small mb-0">Modify academic profile for: <strong>{{ $student->name }}</strong> ({{ $student->student_id }})</p>
                </div>
                <div class="d-flex gap-2 text-nowrap">
                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-eye me-1"></i> View
                    </a>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('students.update', $student->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- Student ID -->
                        <div class="col-md-6">
                            <label for="student_id" class="form-label fw-semibold">
                                Student ID <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('student_id') is-invalid @enderror" 
                                id="student_id" 
                                name="student_id" 
                                value="{{ old('student_id', $student->student_id) }}" 
                                placeholder="e.g. ZUMS-2024-001" 
                                maxlength="20"
                                autocomplete="off"
                                required
                            >
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="form-text">Must be unique across all other students.</div>
                            @enderror
                        </div>

                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $student->name) }}" 
                                placeholder="e.g. Abdullah Al Mamun" 
                                maxlength="100"
                                autocomplete="name"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">
                                Email Address <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $student->email) }}" 
                                placeholder="e.g. mamun@zums.edu" 
                                maxlength="100"
                                autocomplete="email"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="form-text">Must be unique across all other students.</div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">
                                Phone Number <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone', $student->phone) }}" 
                                placeholder="e.g. +880 1712-345678" 
                                maxlength="20"
                                autocomplete="tel"
                                inputmode="tel"
                                required
                            >
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Academic Department -->
                        <div class="col-md-6">
                            <label for="department" class="form-label fw-semibold">
                                Academic Department <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('department') is-invalid @enderror" id="department" name="department" required>
                                @php
                                    $departments = [
                                        'Computer Science & Engineering',
                                        'Software Engineering',
                                        'Business Administration (BBA)',
                                        'Electrical & Electronic Engineering',
                                        'English Language & Literature',
                                        'Economics',
                                        'Law & Justice'
                                    ];
                                    $selectedDept = old('department', $student->department);
                                @endphp
                                @foreach($departments as $dept)
                                    <option value="{{ $dept }}" {{ $selectedDept == $dept ? 'selected' : '' }}>
                                        {{ $dept }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div class="col-md-6">
                            <label for="semester" class="form-label fw-semibold">
                                Current Semester <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('semester') is-invalid @enderror" id="semester" name="semester" required>
                                @php
                                    $semesters = [
                                        '1st Semester',
                                        '2nd Semester',
                                        '3rd Semester',
                                        '4th Semester',
                                        '5th Semester',
                                        '6th Semester',
                                        '7th Semester',
                                        '8th Semester'
                                    ];
                                    $selectedSem = old('semester', $student->semester);
                                @endphp
                                @foreach($semesters as $sem)
                                    <option value="{{ $sem }}" {{ $selectedSem == $sem ? 'selected' : '' }}>
                                        {{ $sem }}
                                    </option>
                                @endforeach
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <hr class="my-4 text-muted">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3">
                        <small class="text-muted">
                            Record created: {{ $student->created_at->format('M d, Y h:i A') }}
                        </small>
                        <div class="d-flex flex-column flex-sm-row gap-2 w-100 justify-content-end">
                            <a href="{{ route('students.index') }}" class="btn btn-light px-4">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-custom-primary px-4">
                                <i class="bi bi-check-lg me-1"></i> Update Student
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
