# Kano State E-Procurement System Documentation

## Overview

The Kano State E-Procurement System is a comprehensive digital platform for managing government procurement processes. It transforms the existing AMP Tender Process system into a full-featured E-Procurement solution with enhanced transparency, accountability, and efficiency.

## System Architecture

### Technology Stack
- **Backend**: Laravel 9 (PHP 8.0+)
- **Frontend**: Blade Templates with Tailwind CSS
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Sanctum
- **API**: RESTful APIs with JSON responses

### Core Modules

1. **User Management & Authentication**
2. **Vendor Management**
3. **Requisition Management**
4. **E-Tendering & Bidding**
5. **Purchase Orders & Contracts**
6. **Invoicing & Payments**
7. **Citizen Transparency Portal**
8. **Audit & Compliance**

## User Roles & Permissions

### 1. Administrator (`admin`)
- Full system access
- User management
- Vendor approval/rejection
- Tender management
- Contract award
- System configuration

### 2. MDA Officer (`mda_officer`)
- Create requisitions
- Manage MDA-specific tenders
- Approve requisitions (HOD/Perm Sec levels)
- View MDA reports

### 3. Vendor (`vendor`)
- Register and manage profile
- Submit bids
- Upload invoices
- Track contract progress
- View payment status

### 4. Media Manager (`media`)
- Manage website content
- Publish news and updates
- Manage galleries and downloads

### 5. Auditor (`auditor`)
- View all transactions
- Generate compliance reports
- Audit trail access
- Export data for external audits

### 6. Citizen (`citizen`)
- Read-only access to public data
- View awarded contracts
- Access transparency portal
- Search tenders and contracts

## Database Schema

### Core Tables

#### Users Table
```sql
- id (Primary Key)
- name
- email (Unique)
- phone
- role (admin, vendor, media, mda_officer, auditor, citizen)
- employee_id
- department (MDA ID)
- position
- status (active, inactive, suspended)
- permissions (JSON)
- profile_image
- last_login_at
- created_at, updated_at
```

#### MDAs Table
```sql
- id (Primary Key)
- name
- code (Unique)
- type (ministry, department, agency)
- description
- head_name, head_title
- email, phone, address
- annual_budget
- status (active, inactive)
- created_at, updated_at
```

#### Vendors Table (Enhanced Applicants)
```sql
- id (Primary Key)
- company_name
- email, phone
- type (individual, company)
- registration_number
- tin_number, bvn
- tax_clearance_certificate
- business_license
- company_registration_certificate
- financial_capacity
- years_in_business
- certifications (JSON)
- approval_status (pending, approved, rejected, blacklisted)
- performance_rating
- vendor_category (micro, small, medium, large)
- specializations (JSON)
- contact_person, contact_phone, contact_email
- approved_at, approved_by
- created_at, updated_at
```

#### Requisitions Table
```sql
- id (Primary Key)
- requisition_number (Unique)
- mda_id (Foreign Key)
- created_by (Foreign Key)
- title, description
- estimated_cost, currency
- budget_line
- procurement_method (open_tender, restricted_tender, direct_procurement, rfq, rfp)
- priority (low, medium, high, urgent)
- status (draft, submitted, hod_approved, perm_sec_approved, procurement_board_approved, rejected, cancelled)
- hod_id, perm_sec_id (Foreign Keys)
- hod_approved_at, perm_sec_approved_at, procurement_board_approved_at
- required_delivery_date
- attachments (JSON)
- created_at, updated_at
```

#### Tenders Table (Enhanced Jobs)
```sql
- id (Primary Key)
- tender_number (Unique)
- requisition_id (Foreign Key)
- mda_id (Foreign Key)
- name, description
- estimated_value, currency
- tender_type (rfq, rfp, itb, open_tender, restricted_tender)
- status (draft, published, open, closed, under_evaluation, awarded, cancelled)
- published_at, opening_date, closing_date
- evaluation_start_date, evaluation_end_date
- evaluation_criteria (JSON)
- bid_security_amount, performance_security_amount
- contract_duration_days
- special_conditions
- required_documents (JSON)
- created_by, evaluation_committee_head (Foreign Keys)
- created_at, updated_at
```

#### Bids Table (Enhanced Applications)
```sql
- id (Primary Key)
- bid_number (Unique)
- vendor_id (Foreign Key)
- tender_id (Foreign Key)
- bid_amount, currency
- validity_period_days
- submission_date
- status (draft, submitted, under_evaluation, technically_qualified, technically_disqualified, financially_evaluated, awarded, rejected, withdrawn)
- technical_score, financial_score, total_score
- rank
- evaluation_notes, rejection_reason
- bid_documents (JSON)
- bid_security_amount, bid_security_document
- created_at, updated_at
```

#### Purchase Orders Table
```sql
- id (Primary Key)
- po_number (Unique)
- tender_id, bid_id, mda_id, vendor_id (Foreign Keys)
- title, description
- amount, currency
- status (draft, issued, acknowledged, in_progress, completed, cancelled)
- issue_date, delivery_date
- delivery_address
- terms_conditions
- line_items (JSON)
- created_by, approved_by (Foreign Keys)
- approved_at
- created_at, updated_at
```

#### Contracts Table
```sql
- id (Primary Key)
- contract_number (Unique)
- purchase_order_id, tender_id, bid_id, mda_id, vendor_id (Foreign Keys)
- title, description
- contract_value, currency
- status (draft, pending_signature, active, in_progress, completed, terminated, expired)
- start_date, end_date, duration_days
- scope_of_work
- deliverables (JSON)
- payment_terms (JSON)
- performance_security_amount, performance_security_document
- special_conditions
- contract_documents (JSON)
- digital_signature_mda, digital_signature_vendor
- signed_at
- created_by, approved_by (Foreign Keys)
- approved_at
- created_at, updated_at
```

#### Invoices Table
```sql
- id (Primary Key)
- invoice_number (Unique)
- contract_id, vendor_id, mda_id (Foreign Keys)
- title, description
- amount, tax_amount, total_amount, currency
- status (draft, submitted, under_review, approved, rejected, paid, cancelled)
- invoice_date, due_date
- line_items (JSON)
- supporting_documents (JSON)
- rejection_reason
- submitted_by, reviewed_by, approved_by (Foreign Keys)
- reviewed_at, approved_at
- created_at, updated_at
```

#### Payments Table
```sql
- id (Primary Key)
- payment_reference (Unique)
- invoice_id, contract_id, vendor_id, mda_id (Foreign Keys)
- amount, currency
- status (pending, processing, approved, paid, failed, cancelled)
- payment_method (bank_transfer, cheque, cash, online)
- bank_name, account_number, account_name
- transaction_reference
- payment_date
- payment_notes
- payment_documents (JSON)
- processed_by, approved_by (Foreign Keys)
- processed_at, approved_at
- created_at, updated_at
```

#### Audit Logs Table
```sql
- id (Primary Key)
- user_id (Foreign Key)
- action
- model_type, model_id
- old_values, new_values (JSON)
- ip_address, user_agent, session_id
- description
- metadata (JSON)
- created_at
```

## API Endpoints

### Citizen Portal (Public APIs)

#### Dashboard Statistics
```
GET /api/citizen/dashboard
Response: {
  "success": true,
  "data": {
    "total_tenders": 150,
    "active_tenders": 25,
    "total_contracts": 300,
    "active_contracts": 45,
    "completed_contracts": 255,
    "total_spent": 2500000000.00,
    "total_mdas": 15,
    "registered_vendors": 500
  }
}
```

#### Tenders
```
GET /api/citizen/tenders
Query Parameters:
- mda_id: Filter by MDA
- tender_type: Filter by type
- status: Filter by status
- per_page: Items per page (default: 15)

GET /api/citizen/tenders/{id}
Response: Tender details with MDA and bids
```

#### Contracts
```
GET /api/citizen/contracts
Query Parameters:
- mda_id: Filter by MDA
- status: Filter by status
- vendor_id: Filter by vendor
- per_page: Items per page (default: 15)

GET /api/citizen/contracts/{id}
Response: Contract details with MDA, vendor, invoices, payments
```

#### Analytics
```
GET /api/citizen/mda-spending
Response: MDA spending statistics

GET /api/citizen/top-contractors
Response: Top 10 contractors by contract value

GET /api/citizen/project-status
Response: Project status summary

GET /api/citizen/mdas
Response: List of all active MDAs
```

#### Search
```
GET /api/citizen/search?q={query}&type={all|tenders|contracts}
Response: Search results for tenders and/or contracts
```

### Authenticated APIs

#### User Profile
```
GET /api/user
Headers: Authorization: Bearer {token}
Response: Current user details
```

#### Role-based API Groups
- `/api/admin/*` - Admin-only endpoints
- `/api/mda/*` - MDA Officer endpoints
- `/api/vendor/*` - Vendor endpoints
- `/api/auditor/*` - Auditor endpoints

## Workflows

### 1. Requisition Workflow
1. **MDA Officer** creates requisition
2. **Head of Department** reviews and approves
3. **Permanent Secretary** reviews and approves
4. **Procurement Board** final approval
5. **Admin** converts to tender

### 2. Tender Workflow
1. **Admin/MDA Officer** creates tender from requisition
2. **Admin** publishes tender
3. **Vendors** submit bids
4. **Evaluation Committee** evaluates bids
5. **Admin** awards tender to winning bid
6. **System** generates purchase order

### 3. Contract Workflow
1. **Admin** creates contract from purchase order
2. **Digital signatures** from MDA and vendor
3. **Contract** becomes active
4. **Vendor** uploads invoices
5. **MDA** reviews and approves invoices
6. **Finance** processes payments

### 4. Vendor Approval Workflow
1. **Vendor** registers and submits documents
2. **Admin** reviews vendor application
3. **Admin** approves or rejects vendor
4. **Approved vendors** can participate in tenders

## Security Features

### Authentication & Authorization
- Role-based access control (RBAC)
- Laravel Policies for fine-grained permissions
- API token authentication with Sanctum
- Session-based authentication for web interface

### Audit Trail
- Complete audit log of all actions
- User activity tracking
- Data change history
- IP address and session tracking

### Data Protection
- Encrypted sensitive data
- Secure file uploads
- Input validation and sanitization
- CSRF protection

## Compliance Features

### Procurement Law Compliance
- Public tender publication
- Transparent evaluation process
- Documented decision making
- Audit trail maintenance

### Reporting
- EFCC compliance reports
- ICPC audit reports
- Auditor-General reports
- Custom analytics dashboards

## Installation & Setup

### Prerequisites
- PHP 8.0 or higher
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (for frontend assets)

### Installation Steps

1. **Clone Repository**
```bash
git clone <repository-url>
cd amp
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Setup**
```bash
php artisan migrate
php artisan db:seed --class=EProcurementSeeder
```

5. **Storage Link**
```bash
php artisan storage:link
```

6. **Build Assets**
```bash
npm run build
```

7. **Start Development Server**
```bash
php artisan serve
```

### Default Login Credentials
- **Admin**: admin@kanoprocurement.gov.ng / password
- **MDA Officer**: fatima.ibrahim@kanohealth.gov.ng / password
- **Auditor**: auditor@kanoprocurement.gov.ng / password

## Frontend Styling

The system uses **Tailwind CSS** for all frontend styling, providing:
- Responsive design
- Modern UI components
- Dark/light mode support
- Consistent design system
- Mobile-first approach

## Mobile App Integration

The system is API-ready for mobile app integration:
- RESTful API endpoints
- JSON responses
- Token-based authentication
- Real-time notifications (future enhancement)

## Future Enhancements

1. **Real-time Notifications**
2. **Mobile App Development**
3. **Advanced Analytics Dashboard**
4. **Integration with Treasury Systems**
5. **Digital Signature Integration**
6. **Blockchain Integration for Transparency**
7. **AI-powered Vendor Matching**
8. **Automated Compliance Checking**

## Support & Maintenance

For technical support and maintenance:
- **Email**: support@kanoprocurement.gov.ng
- **Documentation**: Available in `/docs` directory
- **API Documentation**: Available at `/api/docs` (future enhancement)

## License

This project is proprietary software developed for Kano State Government. All rights reserved.

