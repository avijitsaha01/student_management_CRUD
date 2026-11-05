<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that root '/' redirects to students index.
     */
    public function test_root_redirects_to_students_index(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect(route('students.index'));
    }

    /**
     * Test that students index page loads with student list.
     */
    public function test_can_render_students_index_page(): void
    {
        $student = Student::create([
            'student_id' => 'ZUMS-TEST-001',
            'name'       => 'Test Student',
            'email'      => 'teststudent@zums.edu',
            'phone'      => '+880 1700-000000',
            'department' => 'Computer Science & Engineering',
            'semester'   => '1st Semester',
        ]);

        $response = $this->get(route('students.index'));

        $response->assertStatus(200);
        $response->assertSee('ZUMS-TEST-001');
        $response->assertSee('Test Student');
        $response->assertSee('teststudent@zums.edu');
    }

    /**
     * Test create page loads successfully.
     */
    public function test_can_render_create_student_page(): void
    {
        $response = $this->get(route('students.create'));

        $response->assertStatus(200);
        $response->assertSee('Student Registration Form');
    }

    /**
     * Test storing a new student with valid data.
     */
    public function test_can_create_a_student_successfully(): void
    {
        $payload = [
            'student_id' => 'ZUMS-2024-999',
            'name'       => 'New Applicant',
            'email'      => 'new.applicant@zums.edu',
            'phone'      => '+880 1888-999999',
            'department' => 'Software Engineering',
            'semester'   => '1st Semester',
        ];

        $response = $this->post(route('students.store'), $payload);

        $response->assertStatus(302);
        $response->assertRedirect(route('students.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('students', [
            'student_id' => 'ZUMS-2024-999',
            'email'      => 'new.applicant@zums.edu',
        ]);
    }

    /**
     * Test validation rules for required fields.
     */
    public function test_validation_fails_when_fields_are_missing(): void
    {
        $response = $this->post(route('students.store'), []);

        $response->assertSessionHasErrors([
            'student_id',
            'name',
            'email',
            'phone',
            'department',
            'semester',
        ]);
    }

    /**
     * Test validation prevents duplicate student ID and duplicate email.
     */
    public function test_validation_prevents_duplicate_student_id_and_email(): void
    {
        Student::create([
            'student_id' => 'ZUMS-UNIQUE-01',
            'name'       => 'Original Student',
            'email'      => 'unique@zums.edu',
            'phone'      => '+880 1711-000000',
            'department' => 'Computer Science & Engineering',
            'semester'   => '3rd Semester',
        ]);

        // Attempt duplicate student_id
        $res1 = $this->post(route('students.store'), [
            'student_id' => 'ZUMS-UNIQUE-01',
            'name'       => 'Different Name',
            'email'      => 'different@zums.edu',
            'phone'      => '+880 1711-111111',
            'department' => 'Software Engineering',
            'semester'   => '1st Semester',
        ]);
        $res1->assertSessionHasErrors(['student_id']);

        // Attempt duplicate email
        $res2 = $this->post(route('students.store'), [
            'student_id' => 'ZUMS-ANOTHER-02',
            'name'       => 'Different Name',
            'email'      => 'unique@zums.edu',
            'phone'      => '+880 1711-111111',
            'department' => 'Software Engineering',
            'semester'   => '1st Semester',
        ]);
        $res2->assertSessionHasErrors(['email']);
    }

    /**
     * Test show page displays individual student details.
     */
    public function test_can_render_show_student_page(): void
    {
        $student = Student::create([
            'student_id' => 'ZUMS-SHOW-001',
            'name'       => 'Detail View Student',
            'email'      => 'detail@zums.edu',
            'phone'      => '+880 1711-222333',
            'department' => 'Law & Justice',
            'semester'   => '5th Semester',
        ]);

        $response = $this->get(route('students.show', $student->id));

        $response->assertStatus(200);
        $response->assertSee('Detail View Student');
        $response->assertSee('ZUMS-SHOW-001');
        $response->assertSee('Law & Justice');
    }

    /**
     * Test edit page renders form populated with student data.
     */
    public function test_can_render_edit_student_page(): void
    {
        $student = Student::create([
            'student_id' => 'ZUMS-EDIT-001',
            'name'       => 'Edit View Student',
            'email'      => 'editme@zums.edu',
            'phone'      => '+880 1711-555666',
            'department' => 'Economics',
            'semester'   => '4th Semester',
        ]);

        $response = $this->get(route('students.edit', $student->id));

        $response->assertStatus(200);
        $response->assertSee('Edit Student Information');
        $response->assertSee('ZUMS-EDIT-001');
        $response->assertSee('Edit View Student');
    }

    /**
     * Test updating student data.
     */
    public function test_can_update_student_successfully(): void
    {
        $student = Student::create([
            'student_id' => 'ZUMS-UPD-001',
            'name'       => 'Before Update',
            'email'      => 'before@zums.edu',
            'phone'      => '+880 1711-000000',
            'department' => 'English Language & Literature',
            'semester'   => '2nd Semester',
        ]);

        $updateData = [
            'student_id' => 'ZUMS-UPD-001-NEW',
            'name'       => 'After Update',
            'email'      => 'after@zums.edu',
            'phone'      => '+880 1799-888777',
            'department' => 'Computer Science & Engineering',
            'semester'   => '3rd Semester',
        ];

        $response = $this->put(route('students.update', $student->id), $updateData);

        $response->assertStatus(302);
        $response->assertRedirect(route('students.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('students', [
            'id'         => $student->id,
            'student_id' => 'ZUMS-UPD-001-NEW',
            'name'       => 'After Update',
            'email'      => 'after@zums.edu',
        ]);
    }

    /**
     * Test updating student keeps their own student_id and email without unique validation errors.
     */
    public function test_update_allows_unchanged_student_id_and_email(): void
    {
        $student = Student::create([
            'student_id' => 'ZUMS-SAME-001',
            'name'       => 'Same Credentials',
            'email'      => 'same@zums.edu',
            'phone'      => '+880 1711-000000',
            'department' => 'Computer Science & Engineering',
            'semester'   => '1st Semester',
        ]);

        $response = $this->put(route('students.update', $student->id), [
            'student_id' => 'ZUMS-SAME-001',
            'name'       => 'Updated Name Only',
            'email'      => 'same@zums.edu',
            'phone'      => '+880 1722-334455',
            'department' => 'Software Engineering',
            'semester'   => '2nd Semester',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('students.index'));
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('students', [
            'id'   => $student->id,
            'name' => 'Updated Name Only',
        ]);
    }

    /**
     * Test updating student with another student's existing student_id or email triggers validation errors.
     */
    public function test_update_prevents_duplicate_collision_with_other_students(): void
    {
        $studentA = Student::create([
            'student_id' => 'ZUMS-AAA-001',
            'name'       => 'Student A',
            'email'      => 'studenta@zums.edu',
            'phone'      => '+880 1711-111111',
            'department' => 'Computer Science & Engineering',
            'semester'   => '1st Semester',
        ]);

        $studentB = Student::create([
            'student_id' => 'ZUMS-BBB-002',
            'name'       => 'Student B',
            'email'      => 'studentb@zums.edu',
            'phone'      => '+880 1722-222222',
            'department' => 'Software Engineering',
            'semester'   => '2nd Semester',
        ]);

        // Attempt to change Student B's email to Student A's email
        $res = $this->put(route('students.update', $studentB->id), [
            'student_id' => 'ZUMS-BBB-002',
            'name'       => 'Student B Updated',
            'email'      => 'studenta@zums.edu',
            'phone'      => '+880 1722-222222',
            'department' => 'Software Engineering',
            'semester'   => '2nd Semester',
        ]);

        $res->assertSessionHasErrors(['email']);
    }

    /**
     * Test deleting a student.
     */
    public function test_can_delete_student_successfully(): void
    {
        $student = Student::create([
            'student_id' => 'ZUMS-DEL-001',
            'name'       => 'To Be Deleted',
            'email'      => 'delete.me@zums.edu',
            'phone'      => '+880 1700-112233',
            'department' => 'Business Administration (BBA)',
            'semester'   => '8th Semester',
        ]);

        $response = $this->delete(route('students.destroy', $student->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('students.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);
    }

    /**
     * Test search filter functionality.
     */
    public function test_search_filters_students(): void
    {
        Student::create([
            'student_id' => 'ZUMS-SRCH-001',
            'name'       => 'Alpha Searchable',
            'email'      => 'alpha@zums.edu',
            'phone'      => '+880 1700-000001',
            'department' => 'Computer Science & Engineering',
            'semester'   => '1st Semester',
        ]);

        Student::create([
            'student_id' => 'ZUMS-SRCH-002',
            'name'       => 'Beta Nonmatching',
            'email'      => 'beta@zums.edu',
            'phone'      => '+880 1700-000002',
            'department' => 'Law & Justice',
            'semester'   => '1st Semester',
        ]);

        $response = $this->get(route('students.index', ['search' => 'Alpha']));

        $response->assertStatus(200);
        $response->assertSee('Alpha Searchable');
        $response->assertDontSee('Beta Nonmatching');
    }
}
