const express = require('express');
const mysql = require('mysql2');
const app = express();

// Crear un pool de conexiones a la base de datos MySQL
const pool = mysql.createPool({
    host: 'roundhouse.proxy.rlwy.net',
    user: 'root',
    password: 'hvwoQOsgAfqNDykwHukQJHdNsgpdUtbY',
    database: 'railway',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// Ruta para obtener los detalles de un usuario por ID
app.get('/usuario/:id', (req, res) => {
    const userId = req.params.id;

    // Usar ? para prevenir inyección SQL
    pool.query('SELECT * FROM usuarios WHERE id = ?', [userId], (error, results) => {
        if (error) {
            return res.status(500).json({ error: 'Error en la consulta' });
        }
        res.json(results);
    });
});

// Iniciar el servidor
const PORT = process.env.PORT || 43188;
app.listen(PORT, () => {
    console.log(`Servidor corriendo en el puerto ${PORT}`);
});