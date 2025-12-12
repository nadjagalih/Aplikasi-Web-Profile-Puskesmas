@extends('layouts.main')

@section('content')

<!-- ======= Agenda Section ======= -->
<section id="agenda" class="agenda section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Kalender Agenda Kegiatan Puskesmas</h2>
      <p>Lihat jadwal kegiatan dan acara yang akan dilaksanakan di Puskesmas</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-5 mb-8">
        <div class="widget p-cb">
          <div class="calendar-header">
            <button class="prev-month" onclick="changeMonth(-1)">‹</button>
            <h3 class="current-month"></h3>
            <button class="next-month" onclick="changeMonth(1)">›</button>
          </div>
          <table class="calendar-table">
            <thead>
              <tr>
                <th>Su</th>
                <th>Mo</th>
                <th>Tu</th>
                <th>We</th>
                <th>Th</th>
                <th>Fr</th>
                <th>Sa</th>
              </tr>
            </thead>
            <tbody id="calendar-body">
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-5 col-md-5 mb-8">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Daftar Agenda</h5>
          </div>
          <div class="card-body">
            <div id="agenda-list"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal untuk detail agenda -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eventModalLabel">Detail Agenda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4 id="modalTitle"></h4>
            <p><strong><i class="bi bi-calendar-event me-2"></i>Waktu:</strong></p>
            <p id="modalDate" class="ms-4"></p>
            <div id="modalLocation"></div>
            <div id="modalDescription"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</section><!-- End Agenda Section -->

<style>
  .agenda {
    padding: 60px 0;
    background-color: #f8f9fa;
  }

  .widget.p-cb {
    background: white;
    border-radius: 8px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  }

  .calendar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .calendar-header h3 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
    color: #2c3e50;
  }

  .calendar-header button {
    background: none;
    border: none;
    font-size: 24px;
    color: #6c757d;
    cursor: pointer;
    padding: 4px 12px;
    transition: all 0.2s;
  }

  .calendar-header button:hover {
    color: #2c3e50;
    background: #f8f9fa;
    border-radius: 4px;
  }

  .calendar-table {
    width: 100%;
    border-collapse: collapse;
  }

  .calendar-table thead th {
    text-align: center;
    font-size: 14px;
    font-weight: 600;
    color: #6c757d;
    padding: 12px 4px;
    border-bottom: 1px solid #e9ecef;
  }

  .calendar-table tbody td {
    text-align: center;
    padding: 12px 4px;
    font-size: 14px;
    color: #2c3e50;
    cursor: pointer;
    transition: all 0.2s;
    border-radius: 4px;
  }

  .calendar-table tbody td:hover {
    background: #f8f9fa;
  }

  .calendar-table tbody td.other-month {
    color: #adb5bd;
  }

  .calendar-table tbody td.today {
    background: #4285f4;
    color: white;
    font-weight: 600;
  }

  .calendar-table tbody td.has-event {
    position: relative;
  }

  .calendar-table tbody td.has-event::after {
    content: '';
    position: absolute;
    bottom: 4px;
    left: 50%;
    transform: translateX(-50%);
    width: 4px;
    height: 4px;
    background: #28a745;
    border-radius: 50%;
  }

  .calendar-table tbody td.today.has-event::after {
    background: white;
  }

  #agenda-list {
    max-height: 500px;
    overflow-y: auto;
  }

  .agenda-item {
    padding: 12px 15px;
    border-left: 3px solid #4285f4;
    background: #f8f9fa;
    margin-bottom: 10px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .agenda-item:hover {
    background: #e9ecef;
    transform: translateX(4px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  }

  .agenda-item-title {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 4px;
    font-size: 14px;
    line-height: 1.4;
  }

  .agenda-item-date {
    font-size: 12px;
    color: #6c757d;
    display: flex;
    align-items: center;
  }

  .agenda-item-date i {
    font-size: 11px;
  }

  .agenda-item-location {
    font-size: 12px;
    color: #6c757d;
    margin-top: 4px;
    display: flex;
    align-items: center;
  }

  .agenda-item-location i {
    font-size: 11px;
  }

  @media (max-width: 768px) {
    .widget.p-cb {
      padding: 16px;
    }

    .calendar-table tbody td {
      padding: 8px 2px;
      font-size: 13px;
    }

    .calendar-table thead th {
      padding: 8px 2px;
      font-size: 12px;
    }
  }
</style>

<script>
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let agendaData = [];

// Fetch agenda data
async function fetchAgendaData() {
  try {
    const response = await fetch('/agenda/events');
    agendaData = await response.json();
    renderCalendar();
    renderAgendaList();
  } catch (error) {
    console.error('Error fetching agenda:', error);
  }
}

function renderCalendar() {
  const firstDay = new Date(currentYear, currentMonth, 1);
  const lastDay = new Date(currentYear, currentMonth + 1, 0);
  const prevLastDay = new Date(currentYear, currentMonth, 0);
  
  const firstDayIndex = firstDay.getDay();
  const lastDayIndex = lastDay.getDay();
  const nextDays = 6 - lastDayIndex;
  
  const months = ["January", "February", "March", "April", "May", "June", 
                  "July", "August", "September", "October", "November", "December"];
  
  document.querySelector('.current-month').textContent = `${months[currentMonth]} ${currentYear}`;
  
  let days = "";
  
  // Previous month days
  for (let x = firstDayIndex; x > 0; x--) {
    days += `<td class="other-month">${prevLastDay.getDate() - x + 1}</td>`;
  }
  
  // Current month days
  const today = new Date();
  for (let i = 1; i <= lastDay.getDate(); i++) {
    // Check if this date has events using local year/month/day to avoid timezone shifts
    const hasEvent = agendaData.some(event => {
      const ev = new Date(event.start);
      return ev.getFullYear() === currentYear && ev.getMonth() === currentMonth && ev.getDate() === i;
    });

    const isToday = today.getDate() === i && 
                    today.getMonth() === currentMonth && 
                    today.getFullYear() === currentYear;

    let classes = '';
    if (isToday) classes += 'today ';
    if (hasEvent) classes += 'has-event';

    days += `<td class="${classes}" onclick="selectDate(${currentYear}, ${currentMonth}, ${i})">${i}</td>`;
  }
  
  // Next month days
  for (let j = 1; j <= nextDays; j++) {
    days += `<td class="other-month">${j}</td>`;
  }
  
  // Create table rows
  let rows = '';
  let cells = days.split('</td>');
  for (let i = 0; i < cells.length - 1; i += 7) {
    rows += '<tr>' + cells.slice(i, i + 7).join('</td>') + '</td></tr>';
  }
  
  document.getElementById('calendar-body').innerHTML = rows;
}

function changeMonth(direction) {
  currentMonth += direction;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  } else if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar();
}

function selectDate(year, month, day) {
  const events = agendaData.filter(event => {
    const ev = new Date(event.start);
    return ev.getFullYear() === year && ev.getMonth() === month && ev.getDate() === day;
  });

  if (events.length > 0) {
    showEventModal(events[0]);
  }
}

function renderAgendaList() {
  const agendaListEl = document.getElementById('agenda-list');
  
  if (agendaData.length === 0) {
    agendaListEl.innerHTML = '<p class="text-muted text-center py-4">Belum ada agenda yang terjadwal</p>';
    return;
  }
  
  // Sort by date
  agendaData.sort((a, b) => new Date(a.start) - new Date(b.start));
  
  let html = '';
  agendaData.forEach(event => {
    const eventDate = new Date(event.start);
    const dateStr = eventDate.toLocaleDateString('id-ID', {
      day: 'numeric',
      month: 'short',
      year: 'numeric'
    });
    
    const timeStr = eventDate.toLocaleTimeString('id-ID', {
      hour: '2-digit',
      minute: '2-digit'
    });
    
    html += `
      <div class="agenda-item" onclick='showEventModal(${JSON.stringify(event)})'>
        <div class="agenda-item-title">${event.title}</div>
        <div class="agenda-item-date"><i class="bi bi-calendar-event me-2"></i>${dateStr} • ${timeStr}</div>
        ${event.location ? `<div class="agenda-item-location"><i class="bi bi-geo-alt me-2"></i>${event.location}</div>` : ''}
      </div>
    `;
  });
  
  agendaListEl.innerHTML = html;
}

function showEventModal(event) {
  const start = new Date(event.start);
  const end = event.end ? new Date(event.end) : null;
  
  const formatDate = (date) => {
    return date.toLocaleDateString('id-ID', {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  };
  
  let dateStr = formatDate(start);
  if (end && end.getTime() !== start.getTime()) {
    dateStr += ' - ' + formatDate(end);
  }
  
  document.getElementById('modalTitle').textContent = event.title;
  document.getElementById('modalDate').textContent = dateStr;
  
  if (event.location) {
    document.getElementById('modalLocation').innerHTML = 
      '<p><strong><i class="bi bi-geo-alt me-2"></i>Tempat:</strong></p>' +
      '<p class="ms-4">' + event.location + '</p>';
  } else {
    document.getElementById('modalLocation').innerHTML = '';
  }
  
  if (event.description) {
    document.getElementById('modalDescription').innerHTML = 
      '<p><strong><i class="bi bi-file-text me-2"></i>Deskripsi:</strong></p>' +
      '<p class="ms-4">' + event.description + '</p>';
  } else {
    document.getElementById('modalDescription').innerHTML = '';
  }
  
  var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
  myModal.show();
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
  fetchAgendaData();
});
</script>

@endsection
