<?php

use App\Http\Controllers\{Auth\LoginController,
    Auth\LogoutController,
    BookingController,
    BuildingsController,
    HomeController};
use Illuminate\Support\Facades\Route;

Route::middleware("guest")->group(function () {
    Route::get("/login", [LoginController::class, "index"])->name("auth.login");
    Route::post("/login", [LoginController::class, "store"]);
});

Route::middleware("auth")->group(function () {
    Route::get("/", HomeController::class)->name("index");
    Route::get("/logout", LogoutController::class)->name("auth.logout");

    // Début des routes pour la gestion des réservations-----
    Route::prefix("bookings")->name("bookings.")->group(function () {
        Route::get("/", [BookingController::class, "index"]);
        Route::get("/create", [BookingController::class, "create"]);
        Route::post("/create", [BookingController::class, "insert"]);
        Route::get('/{id}/delete', [BookingController::class, "destroy"]);
        Route::get('/{id}', [BookingController::class, "update"]);
        Route::post("/{id}", [BookingController::class, "updateBD"]);
    });
    // Fin des routes pour la gestion des réservations -------

    // Début des routes pour la gestion des bâtiments -----
    Route::prefix("buildings")->name("buildings.")->group(function () {
        Route::get("/", [BuildingsController::class, "index"]);
        Route::get("/create", [BuildingsController::class, "create"]);
        Route::post("/create", [BuildingsController::class, "insert"]);
        Route::get('/{id}/delete', [BuildingsController::class, "destroy"]);
        Route::get('/{id}', [BuildingsController::class, "update"]);
        Route::post("/{id}", [BuildingsController::class, "updateBD"]);
    });
    // Fin des routes pour la gestion des bâtiments -------
});
