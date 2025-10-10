#!/bin/bash

# Laravel backend indítása
echo "Starting Laravel backend on http://127.0.0.1:8000 ..."
php artisan serve &

# Vite frontend indítása
echo "Starting Vite frontend on http://localhost:5173 ..."
npm run dev
