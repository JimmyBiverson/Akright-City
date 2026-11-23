# Akright City Website Rebuild Proposal

Prepared for: Akright City Residents Association (ACRA)
Prepared by: Webstar
Date: 22 November 2026

## Executive summary

Webstar proposes to rebuild and modernise `akrightcity.com` as a responsive Laravel application with a secure content management system, preserving the association's existing public content and improving speed, accessibility, and maintainability.

The rebuild will be delivered for a fixed fee of **UGX 3,500,000** within **six weeks** from signed contract and handover of content, domain, hosting, and current webmaster access.

## Scope of work

### 1. Content preservation

- Migrate all existing pages and public content from the current site, including:
  - Home, About Us, and Team
  - All twelve village pages
  - Reports and documents
  - Community directory
  - Recent news and news detail
  - FAQs
  - Gallery and YouTube channel
  - Contact details and payment link
- Preserve wording, names, dates, and known spelling exactly as supplied by the current site.
- Preserve all four homepage quick links:
  - Reports & Documents
  - Community Directory
  - Recent Updates & News
  - Frequently Asked Questions

### 2. Laravel rebuild

- Build the site on Laravel with a clean separation of public pages and administrative content.
- Implement a role-protected admin area for managing:
  - Page content
  - Villages
  - Team members
  - Directory entries
  - News posts
  - Reports
  - Gallery images
  - Videos
  - FAQs
  - Partners
  - Contact messages
  - Uploaded media
- Keep legacy `.php` URLs redirecting to the equivalent new routes so existing links do not break.

### 3. Responsive design and user experience

- Deliver a mobile-first, fully responsive layout.
- Replace the current slider behaviour with a single active slide at a time.
- Replace hover-only dropdowns with accessible click/keyboard navigation.
- Add visible focus states, image alt text, readable typography, and consistent spacing.
- Add a lightbox for gallery images.
- Fix duplicate or conflicting styling variables and layout offsets.

### 4. Security hardening

- Add security headers including Content-Security-Policy, HSTS, X-Content-Type-Options, X-Frame-Options/frame-ancestors, Referrer-Policy, and Permissions-Policy.
- Remove or suppress unnecessary server/framework headers where hosting access permits.
- Add CSRF protection, validation, rate limiting, and a honeypot field to the contact form.
- Validate and bind legacy news IDs and redirect unknown IDs safely.
- Add `rel="noopener noreferrer"` to all external links.
- Gate embedded YouTube and map content behind explicit click-to-load behaviour.
- Protect directories that are not meant to be browsable and block sensitive files such as `.env`.
- Add `robots.txt` guidance and an XML sitemap.
- Add canonical, meta description, and Open Graph tags to public pages.

### 5. Testing and handover

- Provide automated feature tests for core routes, contact submission, legacy redirects, and admin access control.
- Run code formatting, frontend build, package audit, and test suite before launch.
- Provide deployment notes, admin login instructions, and a short handover session.

## Timeline

| Week | Deliverable |
| --- | --- |
| 1 | Confirm content freeze, collect access, finalise information architecture, and set up Laravel project |
| 2 | Build content model, import content, and implement legacy URL redirects |
| 3 | Build public responsive pages and navigation |
| 4 | Build admin CMS, contact message inbox, and media manager |
| 5 | Security hardening, SEO metadata, sitemap, accessibility, and cross-browser testing |
| 6 | Final review, fixes, deployment, training, and handover |

The six-week timeline starts after signed contract and complete access/content handover.

## Investment

| Item | Amount |
| --- | --- |
| Fixed rebuild fee | **UGX 3,500,000** |
| Payment 1 — 50% on contract signing | UGX 1,750,000 |
| Payment 2 — 40% on staging approval | UGX 1,400,000 |
| Payment 3 — 10% on launch/handover | UGX 350,000 |

Optional post-launch maintenance and support is available at **UGX 150,000 per month**, covering updates, monitoring, backups coordination, and minor content changes.

The fixed fee includes fourteen days of post-launch bug-fix support.

## Assumptions and client responsibilities

- ACRA provides a complete content freeze and confirms that all content to be preserved is final.
- ACRA provides domain/DNS, hosting, email, and current webmaster access, or introduces the current webmaster/hosting administrator.
- Third-party service credentials are supplied where required.
- Content is supplied in reusable digital form where possible.
- New features outside the agreed scope are quoted separately.

## Acceptance criteria

- All agreed pages are present and content matches the approved source.
- Site is responsive on common mobile, tablet, and desktop widths.
- Legacy URLs redirect correctly.
- Admin users can manage content without editing code.
- Contact form stores messages securely and rejects spam honeypot submissions.
- Non-admin users cannot access the admin area.
- Security headers, sitemap, robots, canonical, and Open Graph tags are present.
- Tests, formatting, frontend build, and audits pass before launch.

## Why Webstar

Webstar has already reviewed the current site's structure, content, and security posture and can deliver the rebuild with minimal disruption to residents. Our approach preserves the association's voice while giving ACRA a secure, maintainable platform for future growth.

## Next steps

1. Confirm approval of the proposal and fee.
2. Confirm the four recipients and copy the association president, ICT minister, and information minister.
3. Introduce Webstar to the current webmaster or hosting administrator.
4. Sign contract and pay the 50% mobilisation payment.
5. Schedule the kickoff and content handover session.
