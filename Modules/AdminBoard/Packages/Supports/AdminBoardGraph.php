<?php

namespace Modules\AdminBoard\Packages\Supports;

class AdminBoardGraph implements AdminBoardGraphContract
{
    /**
     * The Open Graph instance.
     *
     * @var AdminBoardFullGraphContract
     */
    protected $openGraph;

    /**
     * Constructor: Initialize with a Graph-like instance.
     */
    public function __construct()
    {
        $this->setOpenGraph(new AdminGraph());
    }

    /**
     * Set the Open Graph instance.
     *
     * @param AdminBoardFullGraphContract $openGraph
     * @return $this
     */
    public function setOpenGraph(AdminBoardFullGraphContract $openGraph)
    {
        $this->openGraph = $openGraph;
        return $this;
    }

    /**
     * Set the start date on the Open Graph.
     *
     * @param string $date
     * @return $this
     */
    public function setStartDate(string $date)
    {
        $this->openGraph->setStartDate($date);
        return $this;
    }

    /**
     * Get the start date from the Open Graph.
     *
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->openGraph->getStartDate();
    }
    /**
     * Set the start date on the Open Graph.
     *
     * @param string $time
     * @return $this
     */
    public function setSetTime(string $time)
    {
        $this->openGraph->setSetTime($time);
        return $this;
    }

    /**
     * Get the start date from the Open Graph.
     *
     * @return string|null
     */
    public function getSetTime(): ?string
    {
        return $this->openGraph->getSetTime();
    }
    // NEW: pass through addProperty
    public function addProperty(string $key, $value)
    {
        $this->openGraph->addProperty($key, $value);
        return $this;
    }

    // NEW: pass through getProperty
    public function getProperty(string $key)
    {
        return $this->openGraph->getProperty($key);
    }

    public function render()
    {
        return $this->openGraph?->render();
    }

    public function __toString()
    {
        return (string) $this->render();
    }
}
