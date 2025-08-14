import LinkButton from '@/components/LinkButton';
import Pagination from '@/components/Pagination';
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/react';
import { useState } from 'react';


// Defin Order Type
type Order = {
    id:               number;
    order_number:     number;
    customer_details: {
        name:  string;
        email: string;
        phone: string;
    } | null;
    order_date:       string;
    attachment:       string;
    ordering_office:  string;
    ordering_officer: string;
    order_items:      {
        product_id: number;
        name:       string;
        quantity:   number;
        price:      number;
    }[]; 
    allow_shipping:   string;
    shipping_address: string;
    shipping_method:  string;
    shipping_cost:    number;
    status:           string;
    subtotal:         number;
    tax:              number;
    total:            number;
    payment_method:   string;
    payment_status:   string;
}

// Define Pagination Type
type Pagination = {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
};

// Define Props Type 
type PageProps = {
    order_list: Order[];
    pagination: Pagination;
}


// Bredcrumb 
const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard', },
    { title: 'Order', href: '/order', },
];

export default function Index() {
    // Getting Props Through Use Page - Passing PageProps Type
    const { props } = usePage<PageProps>();
    const { order_list, pagination } = props;
    

        
    // Fetch Orders with given filters via Inertia
    const fetchOrders = (params: Partial<{ page: number }>) => {
        const query = {
            page: params.page ?? currentPage,
        };

        router.get('/order', query, {
            preserveState: true,
            replace: true,
        });
    };


    // Pagination 
    const [currentPage, setCurrentPage] = useState(pagination.current_page || 1);    

    // Handle pagination click
    const handlePageChange = (page: number) => {
        setCurrentPage(page);
        fetchOrders({ page });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Order" />


            {/* Start: Page container */}
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                {/* Start: Header */}
                <div className="flex items-center justify-between">
                    <h1 className="text-2xl font-bold">Order</h1>           
                    <LinkButton href="/order/create">+ New Order</LinkButton>
                </div>
                {/* End: Header */}
            
                {/* Start Card */}
                <Card>
                    <CardContent>
                        {/* Responsive Table */}
                        <div className="overflow-x-auto">
                            <table className="text-sm min-w-full table-auto border border-gray-200 dark:border-gray-600 rounded-sm">
                                <thead className="bg-gray-100 text-gray-500 font-light dark:bg-gray-700 dark:text-gray-100">
                                    <tr>
                                        <th className="px-4 py-2 text-left">ID</th>
                                        <th className="px-4 py-2 text-left">Date</th>
                                        <th className="px-4 py-2 text-left">Customer</th>
                                        <th className="px-4 py-2 text-left">Items</th>
                                        <th className="px-4 py-2 text-left">Subtotal</th>
                                        <th className="px-4 py-2 text-left">Total</th>
                                    </tr>
                                </thead>
                                <tbody className="">
                                {order_list.map((order) => (
                                    <tr key={order.id} className="border-t hover:bg-gray-200 dark:border-gray-700 dark:hover:bg-gray-700">
                                        <td className="px-4 py-2">{order.id}</td>
                                        <td className="px-4 py-2">{order.order_date}</td>
                                        <td className="px-4 py-2">{order.customer_details?.name}</td>
                                        <td className="px-4 py-2">{order.order_items?.length || 0}</td>
                                        <td className="px-4 py-2">{order.subtotal}</td>
                                        <td className="px-4 py-2">{order.total}</td>
                                    </tr>
                                ))}
                                </tbody>
                            </table>
                        </div>
                        {/* End Responsive Table */}
                    </CardContent>
                    <CardFooter>
                        <div className="space-y-2">
                            <p className="text-muted-foreground">You have {order_list.length} intractions.</p>
                            <Pagination
                                currentPage={pagination.current_page}
                                totalPages={pagination.last_page}
                                onPageChange={handlePageChange}
                            />
                        </div>
                    </CardFooter>
                </Card>
                {/* End Card */}     
            </div>
            {/* End: Page container */}
        </AppLayout>
    );
}
