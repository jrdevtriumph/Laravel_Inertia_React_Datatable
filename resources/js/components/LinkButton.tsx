import { Link } from '@inertiajs/react'; // Importing Link from Inertia.js
import React from 'react';

// Props type for the LinkButton component
type LinkButtonProps = {
    href: string; // The URL to navigate to
    children: React.ReactNode; // The content inside the button
    className?: string; // Optional additional CSS classes
};

// LinkButton component definition
export default function LinkButton({ href, children, className = '' }: LinkButtonProps) {
    return (
        <Link
            href={href}
            className={`bg-primary hover:bg-primary/90 rounded-lg px-2 py-1 text-white dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600 ${className}`}
        >
            {children}
        </Link>
    );
}
