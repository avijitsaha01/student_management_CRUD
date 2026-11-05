@extends('layouts.app')

@section('title', 'Add New Student - ZUMS Student Management System')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        <!-- Navigation Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('students.index') }}" class="text-decoration-none">Students</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Student</li>
            </ol>
        </nav>

        <div class="card card-custom">
            <div class="card-header bg-white py-3 border-bottom d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3">
                <div>
                    <h5 class="mb-1 fw-bold text-dark">
                        <i class="bi bi-person-plus text-primary me-2"></i>Student Registration Form
                    </h5>
                    <p class="text-muted small mb-0">Enter the student's academic and contact details below.</p>
                </div>
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm text-nowrap">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('students.store') }}" method="POST" novalidate>
                    @csrf

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
                                value="{{ old('student_id') }}" 
                                placeholder="e.g. ZUMS-2024-001" 
                                maxlength="20"
                                autocomplete="off"
                                required
                            >
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="form-text">Must be a unique identification code.</div>
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
                                value="{{ old('name') }}" 
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
                                value="{{ old('email') }}" 
                                placeholder="e.g. mamun@zums.edu" 
                                maxlength="100"
                                autocomplete="email"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="form-text">Must be a valid and unique email address.</div>
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
                                value="{{ old('phone') }}" 
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
                                <option value="" disabled {{ old('department') ? '' : 'selected' }}>Select Department...</option>
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
                                @endphp
                                @foreach($departments as $dept)
                                    <option value="{{ $dept }}" {{ old('department') == $dept ? 'selected' : '' }}>
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
                                <option value="" disabled {{ old('semester') ? '' : 'selected' }}>Select Semester...</option>
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
                                @endphp
                                @foreach($semesters as $sem)
                                    <option value="{{ $sem }}" {{ old('semester') == $sem ? 'selected' : '' }}>
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
                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">
                        <a href="{{ route('students.index') }}" class="btn btn-light px-4">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-custom-primary px-4">
                            <i class="bi bi-save me-1"></i> Save Student Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
