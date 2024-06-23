@extends('layouts.app')
@section('title', 'Rekap')

@section('content')
    <section class="section">

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>Statistics</h4>
                    <div class="card-header-action">
                    </div>
                </div>
                <div class="card-body">
                    <div class="chartjs-size-monitor"
                        style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                        <div class="chartjs-size-monitor-expand"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <div class="statistic-details mt-1">
                        <div class="statistic-details-item">
                            @php
                                // Calculate the percentage change
                                $percentageChange = $yesterday != 0 ? (($today - $yesterday) / $yesterday) * 100 : 0;
                            @endphp

                            <div class="text-small text-muted">
                                <span class="{{ $percentageChange >= 0 ? 'text-primary' : 'text-danger' }}">
                                    <i class="fas fa-caret-{{ $percentageChange >= 0 ? 'up' : 'down' }}"></i>
                                </span>
                                {{ number_format($percentageChange, 2) }}%
                            </div>

                            <div class="detail-value">Rp {{ $today }}</div>
                            <div class="detail-name">Today</div>
                        </div>
                        <div class="statistic-details-item">
                            @php
                                // Calculate the percentage change
                                $percentageChange = $lastWeek != 0 ? (($week - $lastWeek) / $lastWeek) * 100 : 0;
                            @endphp

                            <div class="text-small text-muted">
                                <span class="{{ $percentageChange >= 0 ? 'text-primary' : 'text-danger' }}">
                                    <i class="fas fa-caret-{{ $percentageChange >= 0 ? 'up' : 'down' }}"></i>
                                </span>
                                {{ number_format($percentageChange, 2) }}%
                            </div>

                            <div class="detail-value">Rp {{ $week }}</div>
                            <div class="detail-name">This Week</div>
                        </div>
                        <div class="statistic-details-item">
                            @php
                                // Calculate the percentage change
                                $percentageChange =
                                    $lastYearMonth != 0 ? (($month - $lastYearMonth) / $lastYearMonth) * 100 : 0;
                            @endphp

                            <div class="text-small text-muted">
                                <span class="{{ $percentageChange >= 0 ? 'text-primary' : 'text-danger' }}">
                                    <i class="fas fa-caret-{{ $percentageChange >= 0 ? 'up' : 'down' }}"></i>
                                </span>
                                {{ number_format($percentageChange, 2) }}%
                            </div>
                            <div class="detail-value">Rp {{ $month }}</div>
                            <div class="detail-name">This Month</div>
                        </div>
                        <div class="statistic-details-item">
                            @php
                                // Calculate the percentage change
                                $percentageChange = $lastYear != 0 ? (($year - $lastYear) / $lastYear) * 100 : 0;
                            @endphp

                            <div class="text-small text-muted">
                                <span class="{{ $percentageChange >= 0 ? 'text-primary' : 'text-danger' }}">
                                    <i class="fas fa-caret-{{ $percentageChange >= 0 ? 'up' : 'down' }}"></i>
                                </span>
                                {{ number_format($percentageChange, 2) }}%
                            </div>
                            <div class="detail-value">Rp {{ $year }}</div>
                            <div class="detail-name">This Year</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                      <div class="card-chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="balance-chart" height="116" width="494" style="display: block; width: 247px; height: 58px;" class="chartjs-render-monitor"></canvas>
                      </div>
                      <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-archive"></i>
                      </div>
                      <div class="card-wrap">
                        <div class="card-header">
                          <h4>Today Orders</h4>
                        </div>
                        <div class="card-body">
                           {{ $totalRows }}
                        </div>
                      </div>
                    </div>


                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                      <div class="card-chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="balance-chart" height="116" width="494" style="display: block; width: 247px; height: 58px;" class="chartjs-render-monitor"></canvas>
                      </div>
                      <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                      </div>
                      <div class="card-wrap">
                        <div class="card-header">
                          <h4>Balance</h4>
                        </div>
                        <div class="card-body">
                           Rp. {{ $totalRevenue }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                      <div class="card-chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="balance-chart" height="116" width="494" style="display: block; width: 247px; height: 58px;" class="chartjs-render-monitor"></canvas>
                      </div>
                      <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-shopping-bag"></i>
                      </div>
                      <div class="card-wrap">
                        <div class="card-header">
                          <h4>Sales</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalSales }}
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Total Per Month</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Total</th>
                                <th>details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultsPerMonth as $result)
                            <tr>
                                <td><a href="{{ route('monthly', ['month' => $result['bulan']]) }}">{{ $result['bulan'] }}</a></td>
                                <td><a href="{{ route('monthly', ['month' => $result['bulan']]) }}">{{ number_format($result['total'], 2) }}</a></td>
                                <td><a href="{{ route('monthly', ['month' => $result['bulan']]) }}">Link</a></td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Total Per Year</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resultsPerYear as $tahun => $results)
                                @php
                                    $totalTahun = 0;
                                    foreach ($results as $result) {
                                        $totalTahun += $result['total'];
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $tahun }}</td>
                                    <td>{{ number_format($totalTahun, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
