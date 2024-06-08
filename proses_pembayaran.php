<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_konser = $_POST['id_konser'];
    $tickets_by_type = $_SESSION['tickets_by_type'];

    // Process personal details for each ticket
    $ticket_details = [];
    $total_tickets = count($_POST) / 3; // Assuming each ticket has 3 fields: name, email, phone
    for ($i = 0; $i < $total_tickets; $i++) {
        $ticket_details[] = [
            'name' => $_POST['name_' . $i],
            'email' => $_POST['email_' . $i],
            'phone' => $_POST['phone_' . $i],
        ];
    }

    // TODO: Add your database insertion logic here

    // Clear session variables
    unset($_SESSION['id_konser']);
    unset($_SESSION['tickets_by_type']);

    echo "Pembayaran berhasil diproses.";
}
?>
