document.addEventListener("DOMContentLoaded", function () {
    // Get the current route name from the body or an element attribute (assume it's stored in a data attribute)
    const currentRoute = document.body.getAttribute('data-route-name');

    // Check the current route and expand/collapse accordingly
    if (currentRoute === 'borrowers'
        || currentRoute === 'guarantors'
        || currentRoute === 'refs'
        || currentRoute === 'edit-user'
        || currentRoute === 'client-account'
        ) {
        const sidebarCharts = document.getElementById('sidebarCharts1');

        // Collapse if the current route doesn't match any of the specified routes
        sidebarCharts.classList.add('show');
    } else {
        // Otherwise, collapse it
        sidebarCharts.classList.remove('show');
    }

    // Check the current route and expand/collapse accordingly
    if (currentRoute === 'approved-loans'
        || currentRoute === 'due-loans'
        || currentRoute === 'closed-loans'
        || currentRoute === 'missed-repayments'
        || currentRoute === 'loan-arrears'
        || currentRoute === 'no-repaymentss'
        || currentRoute === 'past-maturity-date'
        || currentRoute === 'one-month-late'
        || currentRoute === 'three-month-late'
        || currentRoute === 'loan-calculator'
        || currentRoute === 'new-loan'
        || currentRoute === 'proxy-loan-create'
        || currentRoute === 'loan-details'
        || currentRoute === 'detailed'
        || currentRoute === 'dashboard'
    ) {
        const sidebarCharts = document.getElementById('sidebarAdvanceUI');
        // Collapse if the current route doesn't match any of the specified routes
        sidebarCharts.classList.add('show');
    } else {
        // Otherwise, collapse it
        sidebarCharts.classList.remove('show');
    }

    // Check the current route and expand/collapse accordingly
    if (currentRoute === 'make-payment'
        || currentRoute === 'loan-wallet'
    ) {
        const sidebarCharts = document.getElementById('sidebarApexcharts');

        // Collapse if the current route doesn't match any of the specified routes
        sidebarCharts.classList.add('show');
    } else {
        // Otherwise, collapse it
        sidebarCharts.classList.remove('show');
    }
}); 


