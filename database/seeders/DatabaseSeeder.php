<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SiteContent;
use App\Models\Schedule;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Nutriólogo Superusuario
        $admin = User::create([
            'name' => 'Nutrióloga Varinia Santiago',
            'email' => 'admin@nutri.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '5551234567',
            'is_active' => true,
        ]);

        // 2. Horarios por defecto para el Nutriólogo
        for ($day = 1; $day <= 5; $day++) {
            Schedule::create([
                'user_id' => $admin->id,
                'day_of_week' => $day,
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
                'is_active' => true,
            ]);
        }

        // 3. 5 Pacientes de Prueba
        $patients = [
            ['name' => 'Carlos López', 'email' => 'carlos@paciente.com'],
            ['name' => 'María García', 'email' => 'maria@paciente.com'],
            ['name' => 'Juan Martínez', 'email' => 'juan@paciente.com'],
            ['name' => 'Ana Hernández', 'email' => 'ana@paciente.com'],
            ['name' => 'Luis González', 'email' => 'luis@paciente.com'],
        ];

        foreach ($patients as $p) {
            User::create([
                'name' => $p['name'],
                'email' => $p['email'],
                'password' => Hash::make('paciente123'),
                'role' => 'patient',
                'phone' => '555' . rand(1000000, 9999999),
                'is_active' => true,
            ]);
        }

        // 4. Contenidos Iniciales para la Landing Page / Publicidad
        SiteContent::create([
            'key_name' => 'doctor_title',
            'title' => 'Nutrióloga Varinia Santiago',
            'content' => 'Licenciada en Nutrición con cédula profesional, especializada en consulta nutricional clínica para el tratamiento y seguimiento de condiciones metabólicas.',
        ]);

        SiteContent::create([
            'key_name' => 'services',
            'title' => 'Nuestros Servicios',
            'content' => "- Control de peso y composición corporal\n- Tratamiento nutricional en condiciones metabólicas\n- Medidas antropométricas\n- Plan de alimentación personalizado",
        ]);

        SiteContent::create([
            'key_name' => 'includes',
            'title' => 'Mi Consulta Incluye',
            'content' => "- Evaluación clínica inicial y revisión de análisis\n- Medición de composición corporal\n- Indicaciones personalizadas en tu expediente digital\n- Seguimiento continuo",
        ]);
    }
}