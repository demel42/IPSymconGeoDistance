<?php

declare(strict_types=1);

require_once __DIR__ . '/../libs/common.php';
require_once __DIR__ . '/../libs/local.php';

class GeoDistance extends IPSModule
{
    use GeoDistance\StubsCommonLib;
    use GeoDistanceLocalLib;

    public function __construct(string $InstanceID)
    {
        parent::__construct($InstanceID);

        $this->CommonConstruct(__DIR__);
    }

    public function __destruct()
    {
        $this->CommonDestruct();
    }

    public function Create()
    {
        parent::Create();

        $this->RegisterAttributeString('UpdateInfo', json_encode([]));
        $this->RegisterAttributeString('ModuleStats', json_encode([]));

        $this->InstallVarProfiles(false);
    }

    public function ApplyChanges()
    {
        parent::ApplyChanges();

        $this->MaintainReferences();

        if ($this->CheckPrerequisites() != false) {
            $this->MaintainStatus(self::$IS_INVALIDPREREQUISITES);
            return;
        }

        if ($this->CheckUpdate() != false) {
            $this->MaintainStatus(self::$IS_UPDATEUNCOMPLETED);
            return;
        }

        if ($this->CheckConfiguration() != false) {
            $this->MaintainStatus(self::$IS_INVALIDCONFIG);
            return;
        }

        $this->MaintainStatus(IS_ACTIVE);
    }

    private function GetFormElements()
    {
        $formElements = $this->GetCommonFormElements('Calculate geo distance');

        if ($this->GetStatus() == self::$IS_UPDATEUNCOMPLETED) {
            return $formElements;
        }

        return $formElements;
    }

    private function GetFormActions()
    {
        $formActions = [];

        if ($this->GetStatus() == self::$IS_UPDATEUNCOMPLETED) {
            $formActions[] = $this->GetCompleteUpdateFormAction();

            $formActions[] = $this->GetInformationFormAction();
            $formActions[] = $this->GetReferencesFormAction();

            return $formActions;
        }

        $formActions[] = $this->GetInformationFormAction();
        $formActions[] = $this->GetReferencesFormAction();

        return $formActions;
    }

    // Distanz zwischen zwei Geo-Koordinaten berechnen (in Kilometern)
    // Quelle: http://phplernen.org/snippets/entfernung-zwischen-zwei-geokoordinaten-berechnen/
    public function Calc(array $cur_loc, array $home_loc = null)
    {
        if (isset($cur_loc['longitude']) && isset($cur_loc['latitude'])) {
            $cur_lon = $cur_loc['longitude'];
            $cur_lat = $cur_loc['latitude'];
        } else {
            return false;
        }

        if (isset($home_loc['longitude']) && isset($home_loc['latitude'])) {
            $home_lon = $home_loc['longitude'];
            $home_lat = $home_loc['latitude'];
        } else {
            $loc = $this->GetSystemLocation();
            $home_lon = $loc['longitude'];
            $home_lat = $loc['latitude'];
        }

        $theta = $home_lon - $cur_lon;
        $dist = sin(deg2rad($home_lat)) * sin(deg2rad($cur_lat)) + cos(deg2rad($home_lat)) * cos(deg2rad($cur_lat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $dist = $dist * 60 * 1.1515 * 1.609344;

        return $dist;
    }
}
