import React from 'react';
import { Navigate, Outlet } from 'react-router-dom';

/**
 * ProtectedRoute — Auth Guard for Admin routes
 * Checks for token in localStorage. Redirects to login if missing.
 */
const ProtectedRoute = () => {
  const token = localStorage.getItem('admin_token');

  if (!token) {
    // If no token, redirect to login page
    return <Navigate to="/admin/login" replace />;
  }

  // If token exists, render the child routes (Outlet)
  return <Outlet />;
};

export default ProtectedRoute;
