import React from "react";
import CoursePerspectiveCard from "@/components/ui/card-14";

export default function Card14DemoUsage() {
  return (
    <div className="flex items-center justify-center min-h-screen w-full bg-slate-100 dark:bg-zinc-950 p-8">
      <CoursePerspectiveCard
        title="Dasar JavaScript & Interaktivitas Web"
        category="JavaScript"
        image="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80"
        rating="5.0"
        reviewsCount="310+ Ulasan"
        hours="24 Jam"
        tutorSessions="10x Sesi"
        benefits="5 Proyek Riil"
        description="Akses materi seumur hidup, code review personal dari mentor praktisi, forum diskusi privat, dan sertifikat resmi penunjang karier."
        price="Rp 99.000"
        originalPrice="Rp 199.000"
        href="/courses/3"
      />
    </div>
  );
}
