<?php
namespace Yuav\RestEncoderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class OutputType extends AbstractType
{

    /**
     *
     * @param FormBuilderInterface $builder            
     * @param array $options            
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("type", null, array(
            "required" => false
        ))
            ->add("label", null, array(
            "required" => false
        ))
            ->add("url", null, array(
            "required" => false
        ))
            ->add("secondaryUrl", null, array(
            "required" => false
        ))
            ->add("base_url", null, array(
            "required" => false
        ))
            ->add("filename", null, array(
            "required" => false
        ))
            ->add("package_filename", null, array(
            "required" => false
        ))
            ->add("package_format", null, array(
            "required" => false
        ))
            ->add("device_profile", null, array(
            "required" => false
        ))
            ->add("strict", null, array(
            "required" => false
        ))
            ->add("skip_video", null, array(
            "required" => false
        ))
            ->add("skip_audio", null, array(
            "required" => false
        ))
            ->add("source", null, array(
            "required" => false
        ))
            ->add("credentials", null, array(
            "required" => false
        ))
            ->add("generate_md5_checksum", null, array(
            "required" => false
        ))
            ->add("parallel_upload_limit", null, array(
            "required" => false
        ))
            ->add("headers", null, array(
            "required" => false
        ))
            ->add("format", null, array(
            "required" => false
        ))
            ->add("video_codec", null, array(
            "required" => false
        ))
            ->add("audio_codec", null, array(
            "required" => false
        ))
            ->add("size", null, array(
            "required" => false
        ))
            ->add("width", null, array(
            "required" => false
        ))
            ->add("height", null, array(
            "required" => false
        ))
            ->add("upscale", null, array(
            "required" => false
        ))
            ->add("aspect_mode", null, array(
            "required" => false
        ))
            ->add("quality", null, array(
            "required" => false
        ))
            ->add("video_bitrate", null, array(
            "required" => false
        ))
            ->add("audio_quality", null, array(
            "required" => false
        ))
            ->add("audio_bitrate", null, array(
            "required" => false
        ))
            ->add("max_video_bitrate", null, array(
            "required" => false
        ))
            ->add("speed", null, array(
            "required" => false
        ))
            ->add("decoder_bitrate_cap", null, array(
            "required" => false
        ))
            ->add("decoder_buffer_size", null, array(
            "required" => false
        ))
            ->add("one_pass", null, array(
            "required" => false
        ))
            ->add("audio_constant_bitrate", null, array(
            "required" => false
        ))
            ->add("frame_rate", null, array(
            "required" => false
        ))
            ->add("max_frame_rate", null, array(
            "required" => false
        ))
            ->add("decimate", null, array(
            "required" => false
        ))
            ->add("keyframe_interval", null, array(
            "required" => false
        ))
            ->add("keyframe_rate", null, array(
            "required" => false
        ))
            ->add("fixed_keyframe_interval", null, array(
            "required" => false
        ))
            ->add("forced_keyframe_interval", null, array(
            "required" => false
        ))
            ->add("forced_keyframe_rate", null, array(
            "required" => false
        ))
            ->add("audio_sample_rate", null, array(
            "required" => false
        ))
            ->add("audio_channels", null, array(
            "required" => false
        ))
            ->add("label", null, array(
            "required" => false
        ))
            ->add("format", null, array(
            "required" => false
        ))
            ->add("number", null, array(
            "required" => false
        ))
            ->add("start_at_first_frame", null, array(
            "required" => false
        ))
            ->add("interval", null, array(
            "required" => false
        ))
            ->add("interval_in_frames", null, array(
            "required" => false
        ))
            ->add("times", null, array(
            "required" => false
        ))
            ->add("aspect_mode", null, array(
            "required" => false
        ))
            ->add("size", null, array(
            "required" => false
        ))
            ->add("width", null, array(
            "required" => false
        ))
            ->add("height", null, array(
            "required" => false
        ))
            ->add("base_url", null, array(
            "required" => false
        ))
            ->add("prefix", null, array(
            "required" => false
        ))
            ->add("filename", null, array(
            "required" => false
        ))
            ->add("public", null, array(
            "required" => false
        ))
            ->add("access_control", null, array(
            "required" => false
        ))
            ->add("grantee", null, array(
            "required" => false
        ))
            ->add("permission", null, array(
            "required" => false
        ))
            ->add("rrs", null, array(
            "required" => false
        ))
            ->add("headers", null, array(
            "required" => false
        ))
            ->add("credentials", null, array(
            "required" => false
        ))
            ->add("parallel_upload_limit", null, array(
            "required" => false
        ))
            ->add("watermarks", null, array(
            "required" => false
        ))
            ->add("url", null, array(
            "required" => false
        ))
            ->add("x", null, array(
            "required" => false
        ))
            ->add("y", null, array(
            "required" => false
        ))
            ->add("width", null, array(
            "required" => false
        ))
            ->add("height", null, array(
            "required" => false
        ))
            ->add("origin", null, array(
            "required" => false
        ))
            ->add("opacity", null, array(
            "required" => false
        ))
            ->add("caption_url", null, array(
            "required" => false
        ))
            ->add("skip_captions", null, array(
            "required" => false
        ))
            ->add("rotate", null, array(
            "required" => false
        ))
            ->add("deinterlace", null, array(
            "required" => false
        ))
            ->add("sharpen", null, array(
            "required" => false
        ))
            ->add("denoise", null, array(
            "required" => false
        ))
            ->add("autolevel", null, array(
            "required" => false
        ))
            ->add("deblock", null, array(
            "required" => false
        ))
            ->add("audio_gain", null, array(
            "required" => false
        ))
            ->add("audio_normalize", null, array(
            "required" => false
        ))
            ->add("audio_pre_normalize", null, array(
            "required" => false
        ))
            ->add("audio_post_normalize", null, array(
            "required" => false
        ))
            ->add("audio_bass", null, array(
            "required" => false
        ))
            ->add("audio_treble", null, array(
            "required" => false
        ))
            ->add("audio_highpass", null, array(
            "required" => false
        ))
            ->add("audio_lowpass", null, array(
            "required" => false
        ))
            ->add("audio_compression_ratio", null, array(
            "required" => false
        ))
            ->add("audio_compression_threshold", null, array(
            "required" => false
        ))
            ->add("audio_expansion_ratio", null, array(
            "required" => false
        ))
            ->add("audio_expansion_threshold", null, array(
            "required" => false
        ))
            ->add("audio_fade", null, array(
            "required" => false
        ))
            ->add("audio_fade_in", null, array(
            "required" => false
        ))
            ->add("audio_fade_out", null, array(
            "required" => false
        ))
            ->add("audio_karaoke_mode", null, array(
            "required" => false
        ))
            ->add("start_clip", null, array(
            "required" => false
        ))
            ->add("clip_length", null, array(
            "required" => false
        ))
            ->add("public", null, array(
            "required" => false
        ))
            ->add("rrs", null, array(
            "required" => false
        ))
            ->add("access_control", null, array(
            "required" => false
        ))
            ->add("grantee", null, array(
            "required" => false
        ))
            ->add("permission", null, array(
            "required" => false
        ))
            ->add("notifications", null, array(
            "required" => false
        ))
            ->add("url", null, array(
            "required" => false
        ))
            ->add("format", null, array(
            "required" => false
        ))
            ->add("headers", null, array(
            "required" => false
        ))
            ->add("event", null, array(
            "required" => false
        ))
            ->add("min_size", null, array(
            "required" => false
        ))
            ->add("max_size", null, array(
            "required" => false
        ))
            ->add("min_duration", null, array(
            "required" => false
        ))
            ->add("max_duration", null, array(
            "required" => false
        ))
            ->add("segment_seconds", null, array(
            "required" => false
        ))
            ->add("segment_size", null, array(
            "required" => false
        ))
            ->add("streams", null, array(
            "required" => false
        ))
            ->add("path", null, array(
            "required" => false
        ))
            ->add("bandwidth", null, array(
            "required" => false
        ))
            ->add("resolution", null, array(
            "required" => false
        ))
            ->add("codecs", null, array(
            "required" => false
        ))
            ->add("segment_image_url", null, array(
            "required" => false
        ))
            ->add("segment_video_snapshots", null, array(
            "required" => false
        ))
            ->add("source", null, array(
            "required" => false
        ))
            ->add("max_hls_protocol_version", null, array(
            "required" => false
        ))
            ->add("hls_optimized_ts", null, array(
            "required" => false
        ))
            ->add("prepare_for_segmenting", null, array(
            "required" => false
        ))
            ->add("instant_play", null, array(
            "required" => false
        ))
            ->add("smil_base_url", null, array(
            "required" => false
        ))
            ->add("encryption_method", null, array(
            "required" => false
        ))
            ->add("encryption_key", null, array(
            "required" => false
        ))
            ->add("encryption_key_url", null, array(
            "required" => false
        ))
            ->add("encryption_key_rotation_period", null, array(
            "required" => false
        ))
            ->add("encryption_key_url_prefix", null, array(
            "required" => false
        ))
            ->add("encryption_iv", null, array(
            "required" => false
        ))
            ->add("encryption_password", null, array(
            "required" => false
        ))
            ->add("decryption_method", null, array(
            "required" => false
        ))
            ->add("decryption_key", null, array(
            "required" => false
        ))
            ->add("decryption_key_url", null, array(
            "required" => false
        ))
            ->add("decryption_password", null, array(
            "required" => false
        ))
            ->add("h264_reference_frames", null, array(
            "required" => false
        ))
            ->add("h264_profile", null, array(
            "required" => false
        ))
            ->add("h264_level", null, array(
            "required" => false
        ))
            ->add("h264_bframes", null, array(
            "required" => false
        ))
            ->add("tuning", null, array(
            "required" => false
        ))
            ->add("crf", null, array(
            "required" => false
        ))
            ->add("cue_points", null, array(
            "required" => false
        ))
            ->add("type", null, array(
            "required" => false
        ))
            ->add("time", null, array(
            "required" => false
        ))
            ->add("name", null, array(
            "required" => false
        ))
            ->add("data", null, array(
            "required" => false
        ))
            ->add("vp6_temporal_down_watermark", null, array(
            "required" => false
        ))
            ->add("vp6_temporal_resampling", null, array(
            "required" => false
        ))
            ->add("vp6_undershoot_pct", null, array(
            "required" => false
        ))
            ->add("vp6_profile", null, array(
            "required" => false
        ))
            ->add("vp6_compression_mode", null, array(
            "required" => false
        ))
            ->add("vp6_2pass_min_section", null, array(
            "required" => false
        ))
            ->add("vp6_2pass_max_section", null, array(
            "required" => false
        ))
            ->add("vp6_stream_prebuffer", null, array(
            "required" => false
        ))
            ->add("vp6_stream_max_buffer", null, array(
            "required" => false
        ))
            ->add("vp6_deinterlace_mode", null, array(
            "required" => false
        ))
            ->add("vp6_denoise_level", null, array(
            "required" => false
        ))
            ->add("alpha_transparency", null, array(
            "required" => false
        ))
            ->add("constant_bitrate", null, array(
            "required" => false
        ))
            ->add("hint", null, array(
            "required" => false
        ))
            ->add("mtu_size", null, array(
            "required" => false
        ))
            ->add("max_aac_profile", null, array(
            "required" => false
        ))
            ->add("force_aac_profile", null, array(
            "required" => false
        ))
            ->add("aspera_transfer_policy", null, array(
            "required" => false
        ))
            ->add("transfer_minimum_rate", null, array(
            "required" => false
        ))
            ->add("transfer_maximum_rate", null, array(
            "required" => false
        ))->add("copy_video", null, array("required" => false))
            ->add("copy_audio", null, array(
            "required" => false
        ));
    }

    /**
     *
     * @param OptionsResolverInterface $resolver            
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Yuav\RestEncoderBundle\Entity\Output'
        ));
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return '';
        // return 'job';
        // return 'yuav_restencoderbundle_job';
    }
}
