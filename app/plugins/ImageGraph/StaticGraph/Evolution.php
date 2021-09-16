<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\ImageGraph\StaticGraph;

/**
 *
 */
class Evolution extends GridGraph
{

    public function renderGraph()
    {
        $this->initGridChart(
            $displayVerticalGridLines = true,
            $bulletType = LEGEND_FAMILY_LINE,
            $horizontalGraph = false,
            $showTicks = true,
            $verticalLegend = true
        );

        $this->pImage->drawLineChart();
    }
}
