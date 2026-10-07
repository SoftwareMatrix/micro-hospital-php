<?php
$siteName = 'Mico Hospital';
$navigation = [
    ['label' => 'Home', 'href' => 'index.php'],
    ['label' => 'About', 'href' => 'about.php'],
    ['label' => 'Treatment', 'href' => 'treatment.php'],
    ['label' => 'Doctors', 'href' => 'doctor.php'],
    ['label' => 'Testimonial', 'href' => 'testimonial.php'],
    ['label' => 'Contact Us', 'href' => 'contact.php'],
];
$departments = ['Nephrologist Care', 'Eye Care', 'Pediatrician Clinic', 'Parental Care'];
$doctors = [
    ['name' => 'Hennry', 'qualification' => 'MBBS', 'image' => 'team1.jpg'],
    ['name' => 'Jenni', 'qualification' => 'MBBS', 'image' => 'team2.jpg'],
    ['name' => 'Morco', 'qualification' => 'MBBS', 'image' => 'team3.jpg'],
];
$testimonials = [
    ['name' => 'Morijorch', 'role' => 'Patient', 'quote' => 'The hospital team provided thoughtful care throughout my visit.'],
    ['name' => 'Rochak', 'role' => 'Patient', 'quote' => 'The doctors answered my questions and made the appointment straightforward.'],
    ['name' => 'Brad Johns', 'role' => 'Patient', 'quote' => 'I appreciated the friendly staff and clear guidance.'],
];
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function submitted($form) { return ($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && ($_POST['form_type'] ?? '') === $form; }
function post_value($key) { return trim((string)($_POST[$key] ?? '')); }
$contactSuccess = submitted('contact') && post_value('name') !== '' && filter_var(post_value('email'), FILTER_VALIDATE_EMAIL) && post_value('phone') !== '' && post_value('message') !== '';
$appointmentDate = DateTimeImmutable::createFromFormat('!Y-m-d', post_value('appointment_date'));
$appointmentSuccess = submitted('appointment')
    && post_value('patient_name') !== ''
    && post_value('phone') !== ''
    && $appointmentDate !== false
    && $appointmentDate->format('Y-m-d') === post_value('appointment_date')
    && in_array(post_value('doctor'), array_column($doctors, 'name'), true)
    && in_array(post_value('department'), $departments, true);
$newsletterSuccess = submitted('newsletter') && (bool) filter_var(post_value('newsletter_email'), FILTER_VALIDATE_EMAIL);
?>